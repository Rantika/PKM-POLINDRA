<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Prody;
use App\Models\Student;
use App\Models\Reviewer;
use App\Models\Dosbing;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosbingController extends Controller
{
    public function index()
    {
        $data['lecturers'] = Lecturer::get();
        $data["tim"] = Tim::get();
        $data['dosbing'] = Dosbing::get();

        return view('admin.data-akun.ploting_dosbing', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Dosbing::create([
                'dosbing_id'   => $request->dosbing_id,
                'student_id'    => $request->student_id
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
                'student_id'      => $request->student_id,
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
        try {
            DB::beginTransaction();

            Reviewer::where("id", $id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menghapus Plotting Reviewer! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Plotting Reviewer!');
    }

}
