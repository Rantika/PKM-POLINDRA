<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $data['groups'] = Group::get();
        return view('admin.master-data.group-jurusan', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Group::create([
                'name'      => $request->name,
                'is_active' => true,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat jurusan! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat jurusan!');
    }

    public function show($id)
    {
        $data = Group::find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Group::find($id)->update([
                'name'      => $request->name,
                'is_active' => $request->status,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate jurusan! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate jurusan!');
    }

    public function delete($id)
    {
        Group::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus jurusan!');
    }
}
