<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data['admins'] = Admin::get();
        return view('admin.data-akun.admin', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'role'      => 'admin',
            ]);

            Admin::create([
                'user_id'       => $user->id,
                'name'          => $request->name,
                'nip'          => $request->nip,
                'phone_number'  => $request->phone_number,
                'is_active'     => true,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat akun admin! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat akun admin!');
    }

    public function show($id)
    {
        $data = Admin::with('user')->find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $admin = tap(Admin::find($id))->update([
                'name'          => $request->name,
                'nip'          => $request->nip,
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
            return redirect()->back()->with('error', 'Gagal mengupdate akun admin! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate akun admin!');
    }

    public function delete($id)
    {
        Admin::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus akun admin!');
    }
}
