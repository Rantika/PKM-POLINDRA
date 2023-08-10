<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
class UploadRevisiController extends Controller
{
    public function index()
    {
        $data['pengaturan'] = Settings::where("kategori", "Revisi")->get();
        return view('admin.setting.revisi.index', $data);
    }

    public function store(Request $request)
    {
        Settings::create([
            'mulai'=>$request->mulai,
            'selesai'=>$request->selesai,
            'status'=>1,
            'kategori'=>'Revisi'
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

        return back();
    }
}
