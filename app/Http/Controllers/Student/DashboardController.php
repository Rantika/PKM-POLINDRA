<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Dosbing;
use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Scheme;
use App\Models\Tim;
use App\Models\TimStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (empty(Auth::user()->tim->id)) {
        } else {
            $data["cekstatus"] = Dosbing::where("student_id", Auth::user()->id)->first();
            $data["proposal"] = Proposal::where("student_id", Auth::user()->id)->first();
            $data["tim_student"] = TimStudent::where("tim_id", Auth::user()->tim->id)->get();
        }
        $data["cek_tim"] = TimStudent::where("tim_id", Auth::user()->tim->id)->get();

        if ($data["cek_tim"]->count() == 0) {
            $data["is_team"] = 0;
        } else {
            $data["is_team"] = 1;
        }
        $data["tim"] = Tim::where("user_id", Auth::user()->id)->first();
        $data["dosbing"] = Lecturer::get();
        $data["schema"] = Scheme::where("deleted_at", NULL)->get();

        return view('tim.index', $data);
    }

    public function post(Request $request)
    {
        if (empty(Auth::user()->tim->proposal)) {
            $dosbing = Dosbing::create([
                "dosbing_id" => $request->dosbing_id,
                "student_id" => Auth::user()->id,
                "status" => 0   
            ]);
    
            $proposal = Proposal::create([
                "student_id" => $dosbing->student_id,
                "lecturer_id" => $dosbing->dosbing_id,
                "scheme_id" => $request->schema_id,
                "title" => $request->title,
                "status" => "0",
                "year" => date("Y"),
                "is_confirmed" => "0",
            ]);
    
            Tim::where("user_id", Auth::user()->id)->update([
                "nama_tim" => $request->nama_tim
            ]);
        } else {
            $proposal = Proposal::where("student_id", Auth::user()->tim->user_id)->first();

            Dosbing::where("student_id", Auth::user()->id)->update([
                "status" => 0,
                "dosbing_id" => $request->dosbing_id
            ]);


            Proposal::where("id", $proposal->id)->update([
                "lecturer_id" => $request->dosbing_id
            ]);   
        }

        return back();
    }
}
