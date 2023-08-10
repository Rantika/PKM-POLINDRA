<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data['pengaturan'] = Settings::where("kategori", "Upload")->get();
        return view('admin.setting.upload.index', $data);
    }

    public function store(Request $request)
    {
        Settings::create([
            'mulai'=>$request->mulai,
            'selesai'=>$request->selesai,
            'status'=>1,
            'kategori'=>'Upload'
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        if($request->has('is_active')){
            Settings::where("id", $id)->update([
                "status" => $request->is_active,
            ]);
        }else{
            Settings::where("id", $id)->update([
                "mulai" => $request->mulai,
                "selesai" => $request->selesai
            ]);
        }

        return back();
    }

    public function delete($id)
    {
        Settings::where("id", $id)->delete();

        Settings::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus Pengaturan Periode!');
    }
}
