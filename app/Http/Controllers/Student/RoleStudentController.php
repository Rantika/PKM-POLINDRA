<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\komen_proposal;
use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoleStudentController extends Controller
{

    public function proposal()
    {
        $data['proposal'] = Proposal::with(['student', 'reviewer.lecturer', 'lecturer', 'scheme', 'comment'])
                            ->where('student_id', Auth::user()->student->id)
                            ->first();

        $data["komen"] = komen_proposal::where("proposal_id", $data["proposal"]["id"])->get();

        return view('tim.proposal.index', $data);
    }

    public function uploadProposal(Request $request)
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
                'file'   => $request->file ? 'proposal/'.date('ymdhis') . '_' . $data->scheme->name . '_' . $request->title .'.'. $request->file->extension() : null,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('proposal'), $data->file);

                // Create Notif untuk dosbing
                $param = [
                    'id'            => (Lecturer::with('user')->find($data->lecturer_id))->user->id,
                    'for'           => 'lecturer',
                    'type'          => 1,
                    'description'   => $data->student->name,
                ];
                NotificationController::create($param);

                // Create Notif untuk Reviewer
                if ($data->reviewer_id){
                    $param = [
                        'id'            => Reviewer::find($data->reviewer_id)->lecturer->user->id,
                        'for'           => 'reviewer',
                        'type'          => 0,
                        'description'   => $data->student->name,
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
                'status'        => 2, // 2 :
                'file_done'     => $request->file ? 'proposal/Hasil AKhir-'.date('ymdhis') . '_' . $data->scheme->name . '_' . $request->title .'.'. $request->file->extension() : null,
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
