<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\NotificationController;
use App\Models\Bimbingan;
use App\Models\Lecturer;
use App\Models\Prody;
use App\Models\Proposal;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleLecturerController extends Controller
{
    public function proposal()
    {
        $data['proposals'] = Proposal::with(['student.user', 'reviewer', 'scheme'])->where('lecturer_id', Auth::user()->lecturer->id)->get();
        return view('dosbing.proposal.index', $data);
    }

    public function showBimbingan($user_id)
    {
        $student = Student::where('user_id', $user_id)->first(); // first : untuk mengambil data dari database namun hanya 1 data saja
        $data['proposal'] = Proposal::where('student_id', $student->id)->first();
        $data['bimbingan'] = Bimbingan::where('user_id', $user_id)->get();

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
        $data = tap(Proposal::with('student.user')->find($id))->update([ // Tap : menyimpan data sebelum di update // find : untuk mengambil data dari database dengan data primary key
            'is_confirmed'    => 1
        ]);

        $param = [
            'id'            => $data->student->user->id,
            'for'           => 'student',
            'type'          => 1,
            'description'   => '',
        ];

        NotificationController::create($param);

        return redirect()->back()->with('success', 'Berhasil mengkonfirmasi proposal!');
    }
}
