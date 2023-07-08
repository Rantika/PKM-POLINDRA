<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Dosbing;
use App\Models\komen_proposal;
use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Revisi;
use App\Models\Settings;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoleStudentController extends Controller
{
    
    public function proposal()
    {
        $cek = Dosbing::where("student_id", Auth::user()->id)->first();
        
        if (empty($cek)) {
            return redirect("/team");
        } else {
            if ($cek->status == 0 || $cek->status == 2) {
                return redirect("/team");
            } else {
                
                $setting_status = Settings::count();
                
                if ($setting_status == 0) {
                    return redirect("/team");
                } else {
                    $data['proposal'] = Proposal::where('student_id', Auth::user()->id)
                    ->first();
                    $data["cekstatus"] = Dosbing::where("student_id", Auth::user()->id)->first();
                    
                    $data["komen"] = komen_proposal::where("proposal_id", $data["proposal"]["id"])->get();
                    
                    // Upload
                    $upload = Settings::where('kategori', 'Upload')->first();
                    
                    $mulai = Carbon::createFromFormat('Y-m-d H:i:s', $upload["mulai"]);
                    $format = $mulai->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                    $data["mulai"] = $format;
                    
                    $selesai = Carbon::createFromFormat('Y-m-d H:i:s', $upload["selesai"]);
                    $format = $selesai->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                    $data["selesai_upload"] = $format;
                    
                    // Review
                    $review = Settings::where("kategori", "Review")->first();
                    
                    $mulai_review = Carbon::createFromFormat('Y-m-d H:i:s', $review["mulai"]);
                    $format_review = $mulai_review->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                    $data["mulai_review"] = $format_review;
                    
                    $selesai_review = Carbon::createFromFormat('Y-m-d H:i:s', $review["selesai"]);
                    $format_review = $selesai_review->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                    $data["selesai_review"] = $format_review;
                    
                    // Revisi
                    $revisi = Settings::where("kategori", "Revisi")->first();
                    
                    $mulai_revisi = Carbon::createFromFormat('Y-m-d H:i:s', $revisi["mulai"]);
                    $format_revisi = $mulai_revisi->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                    $data["mulai_revisi"] = $format_revisi;
                    
                    $selesai_revisi = Carbon::createFromFormat('Y-m-d H:i:s', $revisi["selesai"]);
                    $format_revisi = $selesai_revisi->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
                    $data["selesai_revisi"] = $format_revisi;
                    
                    $sekarang = strtotime(date("Y-m-d H:i:s"));
                    
                    return view('tim.proposal.index', $data, compact("upload","review","revisi"));
                }
            }
        }
    }
    
    public function uploadProposal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|max:20096', // 10MB,
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal membuat data! \n\n Alasan :\nUkuran File yang diupload terlalu besar');
        }
        
        try {
            DB::beginTransaction();
            
            $data = Proposal::with('student')->where('student_id', Auth::user()->id)->first();
            
            $data->update([
                'file'   => $request->file ? 'proposal/'.date('ymdhis') . '_' . $data->scheme->name . '_' . $data->title .'.'. $request->file->extension() : null,
            ]);
            
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('proposal'), $data->file);
                
                // Create Notif untuk dosbing
                $param = [
                    'id'            => Lecturer::with("user")->find($data->lecturer_id)->user->id,
                    'for'           => 'lecturer',
                    'type'          => 1,
                    'description'   => $data->mahasiswa->name,
                ];
                
                NotificationController::create($param);
                
                // Create Notif untuk Reviewer
                if ($data->reviewer_id){
                    $param = [
                        'id'            => Reviewer::find($data->reviewer_id)->lecturer->user->id,
                        'for'           => 'reviewer',
                        'type'          => 0,
                        'description'   => $data->mahasiswa->name,
                    ];
                    NotificationController::create($param);
                }
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Gagal memproses Proposal! \n\n Alasan :\n'. $e->getMessage());
        }
        
        return redirect()->back()->with('success', 'Berhasil memproses Proposal!');
    }
    
    public function uploadProposalDone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|max:5024', // 5MB
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal membuat data! \n\n Alasan :\nUkuran File yang diupload terlalu besar');
        }
        
        try {
            DB::beginTransaction();
            
            $data = Proposal::with('student')->where('student_id', Auth::user()->student->id)->first();
            $data->update([
                'status'        => 2,
                'approved'      => 1
            ]);
            
            Revisi::where("id", $request->proposal_id)->create([
                "proposal_id" => $request->proposal_id,
                "file" => 'proposal/Hasil AKhir-'.date('ymdhis') . '_' . $data->scheme->name . '_' . $request->title .'.'. $request->file->extension()
            ]);
            
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('proposal'), $data->file_done);
                
                // Create notif untuk reviewer
                $param = [
                    'id'            => (Lecturer::with('user')->find($data->lecturer_id))->user->id,
                    'for'           => 'reviewer',
                    'type'          => 1, // 1 :
                    'description'   => $data->student->name,
                ];
                NotificationController::create($param);
                
                // Create notif untuk admin
                $param = [
                    'id'            => User::where('role', 'admin')->first()->id,
                    'for'           => 'admin',
                    'type'          => 2,
                    'description'   => $data->student->name,
                ];
                NotificationController::create($param);
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Gagal memproses Proposal! \n\n Alasan :\n'. $e->getMessage());
        }
        
        return redirect()->back()->with('success', 'Berhasil memproses Proposal!');
    }
    
    public function update(Request $request)
    {
        User::find(Auth::user()->id)->update([
            'email' => $request->email
        ]);
        
        Student::find(Auth::user()->student->id)->update([
            'phone_number'  => $request->phone_number
        ]);
        
        Proposal::where('student_id', Auth::user()->student->id)->update([
            'title'         => $request->title,
            'description'   => $request->description,
        ]);
        
        return redirect()->back()->with([
            'position' => 'profile',
            'success' => 'Update data profile berhasil!'
        ]);
    }
    
    public function changePassword(Request $request)
    {
        if ($request->password != $request->confirm_password){
            return redirect()->back()->with([
                'position' => 'password',
                'error' => 'Password yang anda input tidak sama!'
            ]);
        }
        
        $user = User::find(Auth::user()->id);
        
        if (!Hash::check($request->old, $user->password)){ // hash :
            return redirect()->back()->with([
                'position' => 'password',
                'error' => 'Password lama yang anda masukkan salah!'
            ]);
        }
        
        $user->update([
            'password'  => bcrypt($request->password)
        ]);
        
        return redirect()->back()->with([
            'position' => 'password',
            'success' => 'Berhasil Mengupdate Password!'
        ]);
    }
}
