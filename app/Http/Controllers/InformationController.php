<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    public function index()
    {
        $data['informations'] = Information::get();
        return view('admin.info-pkm.index', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = Information::create([
                'name'          => $request->name,
                'open_time'     => dateFormat($request->open_time),
                'close_time'    => dateFormat($request->close_time),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat informasi kegiatan PKM! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat informasi kegiatan PKM!');
    }

    public function show($id)
    {
        $data = Information::find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Information::find($id)->update([
                'name'          => $request->name,
                'open_time'     => dateFormat($request->open_time),
                'close_time'    => dateFormat($request->close_time),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate informasi kegiatan PKM! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate informasi kegiatan PKM!');
    }

    public function delete($id)
    {
        Information::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus informasi kegiatan PKM!');
    }
}
