<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\NotificationController;
use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleLecturerController extends Controller
{
    public function proposal()
    {
        $data['proposals'] = Proposal::where("lecturer_id", Auth::user()->lecturer->id)->where("file", "!=", NULL)->get();
        return view('dosbing.proposal.index', $data);
    }

    public function showBimbingan($user_id)
    {
        $data['proposal'] = Proposal::where('id', $user_id)->first();

        return response()->json($data); // json : nampilin data terbaru tanpa refresh
    }

    public function getSimbelmawa()
    {
        $data['lecturer'] = Lecturer::find(Auth::user()->lecturer->id); // find : untuk mengambil data dari database dengan data primary key

        return view('dosbing.simbemawa', $data);
    }

    public function confirmBimbingan($id)
    {
        try {
            DB::beginTransaction(); // DB::beginTransaction :
            $data = tap(Bimbingan::with('user.student')->find($id))->update([ // Tap : menyimpan data sebelum di update
                'is_confirmed'    => 1
            ]);

            $param = [
                'id'            => $data->user->id,
                'for'           => 'student',
                'type'          => 0,
                'description'   => $data->description,
            ];

            NotificationController::create($param);
            DB::commit(); //DB::commit :
        } catch (\Exception $e) { // Catch : Exception $e :
            DB::rollBack(); // DB::rollback :
            dd($e->getMessage());
        }

        return response()->json([ // json : nampilin data terbaru tanpa refresh
            'status'    => 'success'
        ]);
    }

    public function confirm($id)
    {
        return DB::transaction(function() use ($id) {

            $data = Proposal::where("id", $id)->update([
                "is_confirmed" => 1
            ]);

            $mahasiswa = Proposal::where("id", $id)->first();
    
            $param = [
                'id'            => $mahasiswa->mahasiswa->user->id,
                'for'           => 'student',
                'type'          => 1,
                'description'   => '',
            ];
    
            NotificationController::create($param);
    
            return redirect()->back()->with('success', 'Berhasil mengkonfirmasi proposal!');
        });
    }
}
