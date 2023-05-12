<?php

namespace App\Http\Controllers;

use App\Models\Prody;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\TimStudent;
use App\Models\Tim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimController extends Controller
{
    public function index()
    {
        $data['tim'] = TimStudent::where('tim_id',Auth::user()->tim->id)->get();
        $data['prody'] = Prody::get();
        if (empty(Auth::user()->tim->nama_tim)) {
            return redirect('team');
        }
        return view('tim.anggota.index', $data);
    }


    public function store(Request $request)
    {
        // echo Auth::user()->tim;

        // die();
        try {
            DB::beginTransaction();

            $user = Student::create([
                'name'              => $request->name,
                'nim'               => $request->nim,
                'phone_number'      => $request->phone_number,
                'prody_id'          => $request->prody_id
            ]);

            $user = TimStudent::create([
                'student_id'              => $user['id'],
                'tim_id'               =>Auth::user()->tim->id,
            ]);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan tim! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat menambahkan tim!');
    }

    public function show($id)
    {
        $data = Student::with('user')->find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
           
            $tim = TimStudent::where("id", $id)->first();

            $user = Student::where("id", $tim["student_id"])->update([
                'name'              => $request->name,
                'nim'               => $request->nim,
                'phone_number'      => $request->phone_number,
                'prody_id'          => $request->prody_id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate akun tim! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate akun tim!');
    }

    public function delete($id)
    {
        Student::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus akun tim!');
    }

    public function updateSimbelmawa(Request $request, $id)
    {
        $data = tap(Student::with('user')->find($id))->update([
            'username_simbelmawa'   => $request->username_simbelmawa,
            'password_simbelmawa'   => $request->password_simbelmawa,
        ]);

        $param = [
            'id'            => $data->user->id,
            'for'           => 'student',
            'type'          => 3,
            'description'   => '',
        ];

        NotificationController::create($param);

        return redirect()->back()->with('success', 'Berhasil menambahkan akun simbelmawa tim!');
    }
}
