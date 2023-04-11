<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Scheme;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    public function index()
    {
        $data['students'] = Student::with('prody')->get();
        $data['lecturers'] = Lecturer::get();
        $data['reviewers'] = Reviewer::with('lecturer')->get();
        $data['schemes'] = Scheme::get();
        $data['proposals'] = Proposal::with(['student', 'lecturer', 'reviewer.lecturer', 'scheme'])->get();

        return view('admin.tim-pkm.index', $data);
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

            $scheme = Scheme::find($request->scheme_id);
            $proposal = Proposal::create([
                'student_id'    => $request->student_id,
                'lecturer_id'   => $request->lecturer_id,
                'reviewer_id'   => $request->reviewer_id,
                'scheme_id'     => $request->scheme_id,
                'title'         => $request->title,
                'description'   => $request->description,
                'file'          => $request->file ? date('ymdhis') . '_' . $scheme->name . '_' . $request->title .'.'. $request->file->extension() : null,
                'status'        => 0,
                'year'          => date('Y'),
                'is_confirmed'  => false,
            ]);

            Lecturer::find($request->lecturer_id)->update([
                'is_dosbing'    => true
            ]);

            $reviewer = Reviewer::find($request->reviewer_id);

            Lecturer::find($reviewer->lecturer_id)->update([
                'is_reviewer'   => true
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->move(public_path('proposal'), $proposal->file);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat proposal tim! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil membuat proposal tim!');
    }

    public function show($id)
    {
        $data = Proposal::with(['student', 'lecturer', 'reviewer.lecturer', 'scheme'])->find($id);
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

            $scheme = Scheme::find($id);
            Proposal::find($id)->update([
                'lecturer_id'   => $request->lecturer_id,
                'reviewer_id'   => $request->reviewer_id,
                'scheme_id'     => $request->update_scheme_id,
                'title'         => $request->title,
                'description'   => $request->description,
                'year'          => $request->year,
            ] + ($request->file ? [
                'file'          => date('ymdhis') . '_' . $scheme->name . '_' . $request->title .'.'. $request->file->extension()
            ] : []));

            Lecturer::find($request->lecturer_id)->update([
                'is_dosbing'    => true
            ]);

            if($request->reviewer_id){
                $reviewer = Reviewer::find($request->reviewer_id);

                if($reviewer){
                    Lecturer::find($reviewer->lecturer_id)->update([
                        'is_reviewer'   => true
                    ]);
                }
                Lecturer::find($reviewer->lecturer_id)->update([
                    'is_reviewer'   => true
                ]);
            }


            if ($request->hasFile('file')) {
                $proposal = Proposal::find($id);
                $file = $request->file('file');
                $file->move(public_path('proposal'), $proposal->file);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate proposal tim! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate proposal tim!');
    }

    public function lolos($id)
    {
        try {
            DB::beginTransaction();

            Proposal::find($id)->update([
                'status'    => 3, // 3 :
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate proposal tim! \n\n Alasan :\n'. $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate proposal tim!');
    }

    public function delete($id)
    {
        Proposal::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus proposal tim!');
    }

    public function showBimbingan($user_id)
    {
        $data['bimbingan'] = Bimbingan::where('user_id', $user_id)->get();

        return response()->json($data);
    }
}
