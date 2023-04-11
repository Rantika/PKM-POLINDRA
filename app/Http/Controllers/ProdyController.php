<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Prody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdyController extends Controller
{
    public function index()
    {
        $data['prodies'] = Prody::with('group')->get();
        $data['groups'] = Group::get();
        return view('admin.master-data.group-prodi', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Prody::create([
                'name'      => $request->name,
                'short'     => $request->short,
                'group_id'  => $request->group_id,
                'is_active' => true,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat prodi! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat prodi!');
    }

    public function show($id)
    {
        $data = Prody::find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Prody::find($id)->update([
                'name'      => $request->name,
                'short'     => $request->short,
                'group_id'  => $request->group_id,
                'is_active' => $request->status,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate prodi! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate prodi!');
    }

    public function delete($id)
    {
        Prody::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus prodi!');
    }
}
