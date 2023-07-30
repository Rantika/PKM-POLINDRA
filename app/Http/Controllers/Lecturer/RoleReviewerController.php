<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Comment;
use App\Models\komen_proposal;
use App\Models\Komentar;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Revisi;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleReviewerController extends Controller
{
    public function proposal()
    {
        $reviewTeamIds = Reviewer::where('lecturer_id', Auth::user()->lecturer->id)->pluck('id');
        $data['settings']= Settings::where('kategori','Review')->first();
        $data['proposals'] = Proposal::whereIn('reviewer_id', $reviewTeamIds)->get();
        // dd($reviewTeamIds, $data['proposals']);
        
        return view('reviewer.proposal.index', $data);
    }
    public function komentar($id)
    {
        $data['proposals'] = Proposal::where('id',$id)->first();
        
        return view('reviewer.proposal.belum-review.index',$data);
    }

    public function post_komentar(Request $request)
    {
        return DB::transaction(function() use ($request) {
            Proposal::find($request["proposal_id"])->update([
                'status' => 1
            ]);

            Komentar::create([
                "user_id" => Auth::user()->id,
                "proposal_id" => $request["proposal_id"],
                "komentar" => $request["komentar"],
                "parent" => $request["parent"] 
            ]);

            return back();
        });
    }

    public function file_revisi($id_proposal)
    {
        $data["proposals"] = Proposal::where("id", $id_proposal)->first();
        $data["file"] = Revisi::where("proposal_id", $data["proposals"]["id"])->get();
        
        return view("reviewer.proposal.file_revisi", $data);
    }

    public function setujui(Request $request)
    {
        Proposal::where("id", $request->proposal_id)->update([
            "status" => 3,
            "approved" => 0 
        ]);

        return back();
    }
    
    public function getProposal($id)
    {
        $data = Revisi::where('proposal_id', $id)->first(); // find : untuk mengambil data dari database dengan data primary key

        return response()->json($data); // json : nampilin data terbaru tanpa refresh
    }

    public function confirm($id)
    {
        $data = tap(Proposal::with('student.user')->find($id))->update([ // Tap : menyimpan data sebelum di update // find : untuk mengambil data dari database dengan data primary key
            'is_confirmed'    => 1
        ]);

        $param = [
            'id'            => $data->student->user->id,
            'for'           => 'student',
            'type'          => 2,
            'description'   => '',
        ];

        NotificationController::create($param);

        return redirect()->back()->with('success', 'Berhasil mengkonfirmsi proposal!');
    }

    public function update_status($id)
    {
        Proposal::where("id", $id)->update([
            "status" => 1
        ]);
    }

    public function proses_belum_review(Request $request)
    {
        $proposal = Proposal::where("id", $request->proposal_id)->first();

        komen_proposal::create([
            "proposal_id" => $request->proposal_id,
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "deskripsi" => $request->deskripsi
        ]);

        if ($proposal->status == 0) {
            if ($proposal->approved == 0) {
                $approved = 0;
            } 
        } else {
            if ($proposal->approved == 0) {
                $approved = 1;
            } else {
                $approved = 0;
            }
        }

        Proposal::where("id", $request->proposal_id)->update([
            "status" => 1,
            "approved" => $approved
        ]);

        return back();
    }

    public function upload(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|max:5024', // 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal membuat data! \n\n Alasan :\nUkuran File yang diupload terlalu besar');
        }

        try {
            DB::beginTransaction();

            $data = Proposal::with('student.user')->find($id); // find : untuk mengambil data dari database dengan data primary key
            $data->update([
                'status'        => 1,
                'file_review'   => $request->file ? 'proposal/Review-'. $data->reviewer->lecturer->name .'-' .$data->title . '-' . date('Ymd').'.'. $request->file->extension() : null,
            ]);

            $commnet = Comment::create([
                'proposal_id'       => $data->id,
                'cover'             => $request->cover,
                'kata_pengantar'    => $request->kata_pengantar,
                'bab_1'             => $request->bab_1,
                'bab_2'             => $request->bab_2,
                'bab_3'             => $request->bab_3,
                'daftar_pustaka'    => $request->daftar_pustaka,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('proposal'), $data->file_review);
            }

            $param = [
                'id'            => $data->student->user->id,
                'for'           => 'student',
                'type'          => 2,
                'description'   => '',
            ];

            NotificationController::create($param);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memproses Proposal! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil memproses Proposal!');
    }

    public function proposal_disetujui($id_proposal)
    {
        try {
            DB::beginTransaction();
            
            echo "Ada";

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with("error", "Proposal Gagal Disetujui" . $e->getMessage());
        }
    }

    public function download($id_proposal, $id_file)
    {
        $file = Revisi::where("id", $id_file)->first();
        
        echo $file;
    }

    public function ubah(Request $request, $id_proposal, $id_file)
    {
        try {
            DB::beginTransaction();

            if ($request->status == "1") {
                $status = "1";
            } else if ($request->status == "2") {
                $status = "3";
            }

            Proposal::where("id", $id_proposal)->update([
                "status" => $status
            ]);

            Revisi::where("id", $id_file)->update([
                "status" => $request->status
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with("error", "Data Gagal di Simpan" . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Status Berhasil di Ubah');
    }

    public function setujui_proposal($id_proposal)
    {
        try {
            DB::beginTransaction();

            Proposal::where("id", $id_proposal)->update([
                "approved" => 1
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with("error", "Data Gagal di Simpan" . $e->getMessage());
        }

        return redirect("/reviewer/proposal")->with('success', 'Status Berhasil di Ubah');
    }
}
