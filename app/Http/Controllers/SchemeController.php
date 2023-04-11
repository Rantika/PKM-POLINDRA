<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SchemeController extends Controller
{
    public function index()
    {
        $data['schemes'] = Scheme::get();
        return view('admin.master-data.skema-pkm', $data);
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

            $data = Scheme::create([
                'name'          => $request->name,
                'short'         => $request->short,
                'description'   => $request->description,
                'condition'     => $request->condition,
                'file'          => $request->file ? 'scheme/Template-'.$request->name . '-' . date('Ymd').'.'. $request->file->extension() : null,
                'is_active'     => true,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('scheme'), $data->file);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat skema PKM! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat skema PKM!');
    }

    public function show($id)
    {
        $data = Scheme::find($id);
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

            Scheme::find($id)->update([
                'name'          => $request->name,
                'short'         => $request->short,
                'description'   => $request->description,
                'condition'     => $request->condition,
                'is_active'     => $request->status,
            ] + ($request->file ? [
                'file'          => 'scheme/Template-'.$request->name . '-' . date('Ymd'). $request->file->extension()
            ] : []));

            if ($request->hasFile('file')) {
                $scheme = Scheme::find($id);
                $file = $request->file('file');
                $file->move(public_path('scheme'), $scheme->file);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate skema PKM! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate skema PKM!');
    }

    public function delete($id)
    {
        Scheme::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus skema PKM!');
    }
}
