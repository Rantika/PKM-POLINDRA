<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $data['news'] = News::get();
        return view('admin.berita-pkm.index', $data);
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

            $data = News::create([
                'title'         => $request->title,
                'description'   => $request->description,
                'photo'         => $request->file ? 'news_file/'.$request->title . '-' . date('Ymd').'.'. $request->file->extension() : null,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('news_file'), $data->photo);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat jenis kegiatan PKM! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat jenis kegiatan PKM!');
    }

    public function show($id)
    {
        $data = News::find($id);
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

            News::find($id)->update([
                    'title'         => $request->title,
                    'description'   => $request->description,
                ] + ($request->file ? [
                    'photo'          => 'news_file/'.$request->title . '-' . date('Ymd').'.'. $request->file->extension()
                ] : []));

            if ($request->hasFile('file')) {
                $news_file = News::find($id);
                $file = $request->file('file');
                $file->move(public_path('news_file'), $news_file->photo);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate jenis kegiatan PKM! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate jenis kegiatan PKM!');
    }

    public function delete($id)
    {
        News::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus jenis kegiatan PKM!');
    }
}
