<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Prody;
use App\Models\Student;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewerController extends Controller
{
    public function index()
    {
        $data['lecturers'] = Lecturer::get();
        $data['mahasiswa'] = Student::get();
        $data['reviewers'] = Reviewer::with(['lecturer', 'prody'])->get();

        return view('admin.data-akun.reviewer', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Reviewer::create([
                'lecturer_id'   => $request->lecturer_id,
                'prody_id'      => $request->prody_id,
            ]);

            Lecturer::find($request->lecturer_id)->update([
                'is_reviewer'   => true
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat Plotting Reviewer! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat Plotting Reviewer!');
    }

    public function show($id)
    {
        $data = Reviewer::find($id);
        return response()->json($data);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Reviewer::find($id)->update([
                'lecturer_id'   => $request->lecturer_id,
                'prody_id'      => $request->prody_id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate Plotting Reviewer! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate Plotting Reviewer!');
    }

    public function delete($id)
    {
        $data = Reviewer::find($id);
        try {
            DB::beginTransaction();

            Lecturer::find($data->lecturer_id)->update([
               'is_reviewer' => 0
            ]);
            $data->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Plotting Reviewer! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Plotting Reviewer!');
    }

}
