<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Prody;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LecturerController extends Controller
{
    public function index()
    {
        $data['prodies'] = Prody::get();
        $data['lecturers'] = Lecturer::get();
        return view('admin.data-akun.dosbing', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|max:5024', // 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal membuat data! \n\n Alasan :\nUkuran File yang diupload terlalu besar');
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'role'      => 'lecturer',
            ]);

            $data = Lecturer::create([
                'user_id'       => $user->id,
                'prody_id'      => $request->prody_id,
                'name'          => $request->name,
                'nip'          => $request->nip,
                'phone_number'  => $request->phone_number,
                'photo'         => $request->file ? 'lecturer_file/'.$request->name . '-' . date('Ymd').'.'. $request->file->extension() : null,
                'is_active'     => true,
                'is_reviewer'   => false,
                'is_dosbing'    => false,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('lecturer_file'), $data->photo);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat akun dosen! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat akun dosen!');
    }

    public function show($id)
    {
        $data = Lecturer::with('user')->find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|max:5024', // 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal membuat data! \n\n Alasan :\nUkuran File yang diupload terlalu besar');
        }

        try {
            DB::beginTransaction();
            $admin = tap(Lecturer::find($id))->update([
                'prody_id'      => $request->prody_id,
                'name'          => $request->name,
                'nip'          => $request->nip,
                'phone_number'  => $request->phone_number,
                'is_active'     => $request->status,
            ] + ($request->file ? [
                'photo'          => 'lecturer_file/'.$request->name . '-' . date('Ymd').'.'. $request->file->extension()
            ] : []));

            if ($request->hasFile('file')) {
                $lecturer_file = Lecturer::find($id);
                $file = $request->file('file');
                $file->move(public_path('lecturer_file'), $lecturer_file->photo);
            }

            User::find($admin->user_id)->update([
                    'email'     => $request->email
                ] + ($request->password ? [
                    'password'          => bcrypt($request->password)
                ] : []));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate akun dosen! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate akun dosen!');
    }

    public function delete($id)
    {
        Lecturer::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus akun dosen!');
    }

    public function updateSimbelmawa(Request $request, $id)
    {
        $data = tap(Lecturer::with('user')->find($id))->update([
            'username_simbelmawa'   => $request->username_simbelmawa,
            'password_simbelmawa'   => $request->password_simbelmawa,
        ]);

        $param = [
            'id'            => $data->user->id,
            'for'           => 'lecturer',
            'type'          => 2, // 2 :
            'description'   => '',
        ];
        NotificationController::create($param);

        return redirect()->back()->with('success', 'Berhasil menambahkan akun simbelmawa dosen!');
    }
}
