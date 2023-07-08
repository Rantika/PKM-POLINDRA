<?php

namespace App\Http\Controllers;

use App\Models\Prody;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $data['prodies'] = Prody::get();
        $data['students'] = Student::get();
        //return view('admin.data-akun.tim', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'email'     => $request->email,
                'password'  => bcrypt($request->password ?? 'password'),
                'role'      => 'student',
            ]);

            Student::create([
                'user_id'       => $user->id,
                'prody_id'      => $request->prody_id,
                'name'          => $request->name,
                'nim'          => $request->nim,
                'phone_number'  => $request->phone_number,
                'year'          => date('Y'),
                'is_active'     => true,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat akun tim! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat akun tim!');
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
            $admin = tap(Student::find($id))->update([
                'prody_id'      => $request->prody_id,
                'name'          => $request->name,
                'nim'          => $request->nim,
                'year'          => $request->year,
                'phone_number'  => $request->phone_number,
                'is_active'     => $request->status,
            ]);

            User::find($admin->user_id)->update([
                    'email'     => $request->email
                ] + ($request->password ? [
                    'password'          => bcrypt($request->password)
                ] : []));

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
