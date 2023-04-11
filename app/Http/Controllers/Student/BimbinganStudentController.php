<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Bimbingan;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BimbinganStudentController extends Controller
{
    public function index()
    {
        $data['bimbingans'] = Bimbingan::where('user_id', Auth::user()->id)->get();
        return view('tim.bimbingan.index', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = Bimbingan::create([
                'user_id'       => Auth::user()->id,
                'lecturer_id'   => Auth::user()->student->proposal->lecturer->id,
                'date'          => dateFormat($request->date),
                'description'   => $request->description,
                'is_confirmed'  => 0
            ]);

            // Create Notif untuk dosbing
            $param = [
                'id'            => (Lecturer::with('user')->find($data->lecturer_id))->user->id,
                'for'           => 'lecturer',
                'type'          => 0,
                'description'   => Auth::user()->student->name,
            ];
            NotificationController::create($param);

            // Create Notif untuk admin
            $param = [
                'id'            => User::where('role', 'admin')->first()->id,
                'for'           => 'admin',
                'type'          => 1,
                'description'   => Auth::user()->student->name,
            ];
            NotificationController::create($param);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat data bimbingan! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat data bimbingan!');
    }

    public function show($id)
    {
        $data = Bimbingan::find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Bimbingan::find($id)->update([
                'date'          => dateFormat($request->date),
                'description'   => $request->description,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate data bimbingan! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate data bimbingan!');
    }

    public function delete($id)
    {
        Bimbingan::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data bimbingan!');
    }
}
