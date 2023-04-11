<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodController extends Controller
{
    public function index()
    {
        $data['periods'] = Period::latest()->get();
        return view('admin.setting.period', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Period::where('is_active', 1)->update([
                'is_active'  => 0,
            ]);

            Period::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'is_active'     => 1
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat Pengaturan Periode! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat Pengaturan Periode!');
    }

    public function show($id)
    {
        $data = Period::find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Period::find($id)->update([
                'name'          => $request->name,
                'description'   => $request->description,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate Pengaturan Periode! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate Pengaturan Periode!');
    }

    public function updateStatus($id, Request $request)
    {
        try {
            DB::beginTransaction();

            if($request->is_active){
                Period::where('is_active', 1)->update([
                    'is_active'  => 0,
                ]);
            }

            Period::find($id)->update([
                'is_active'  => $request->is_active,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate Status Periode! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate Status Periode!');
    }

    public function delete($id)
    {
        Period::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus Pengaturan Periode!');
    }
}
