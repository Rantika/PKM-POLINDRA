<?php

namespace App\Http\Controllers;

use App\Models\Dosbing;
use App\Models\Lecturer;
use App\Models\Prody;
use App\Models\Proposal;
use App\Models\Student;
use App\Models\Reviewer;
use App\Models\UsersRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewerController extends Controller
{
    public function index()
    {
        $data['lecturers'] = Lecturer::get();
        $data['mahasiswa'] = Dosbing::where("status", 1)->get();
        $data['reviewers'] = Reviewer::with(['lecturer', 'prody'])->get();

        return view('admin.data-akun.reviewer', $data);
    }

    public function store(Request $request)
    {
        $student = Student::where("id", $request->student_id)->first();

        try {
            DB::beginTransaction();
            $data = Reviewer::create([
                'lecturer_id'   => $request->lecturer_id,
                'student_id'    => $request->student_id
            ]);
            
            $cek = UsersRole::where("user_id", $data->lecturer->user->id)->where("role", "Reviewer")->count();

            if ($cek == 0) {
                UsersRole::create([
                    "user_id" => $data->lecturer->user->id,
                    "role" => "Reviewer"
                ]);
            }

            Proposal::where("student_id", $student->user_id)->update([
                "reviewer_id" => $data->id
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
