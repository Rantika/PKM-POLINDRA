<?php

namespace App\Http\Controllers;

use App\Models\ViewConf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ViewConfController extends Controller
{
    public function index()
    {
        $data['configs'] = ViewConf::get();
        return view('admin.setting.view-conf', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'short' => 'string|max:5', // 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Singkatan yang dibuat terlalu panjang!');
        }

        try {
            DB::beginTransaction();

            ViewConf::updateOrCreate(
                ['name' => 'short'],
                [
                    'value' => $request->short,
                ]
            );

            ViewConf::updateOrCreate(
                ['name' => 'name'],
                [
                    'value' => $request->name,
                ]
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Mengupdate Pengaturan Tampilan! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil Mengupdate Pengaturan Tampilan!');
    }

    public function show($id)
    {
        $data = ViewConf::find($id);
        return response()->json($data);
    }

    public function storeLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required', // 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Gagal membuat data! \n\n Alasan :\nUkuran File yang diupload terlalu besar/tidak ada file yang diupload!');
        }
        
        try {
            DB::beginTransaction();

            $data = ViewConf::updateOrCreate(
                ['name' => 'logo'],
                [
                    'value'         => null,
                    'file'          => $request->file ? 'home/assets/img/Logo-' . date('Ymd').'.'. $request->file->extension() : null,
                ]
            );

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('home/assets/img'), $data->file);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate Logo Aplikasi! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate Logo Aplikasi!');
    }

    public function delete($id)
    {
        ViewConf::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus Pengaturan Tampilan!');
    }
}
