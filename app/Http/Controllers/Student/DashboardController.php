<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Tim;
use App\Models\TimStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['proposal'] = Proposal::with(['student', 'reviewer.lecturer', 'lecturer', 'scheme', 'comment'])
            ->where('student_id', Auth::user()->student->id)
            ->first();

            if (empty(Auth::user()->tim->id)) {
            
            } else {
                $data["tim_student"] = TimStudent::where("tim_id", Auth::user()->tim->id)->get();
            }
        $data["tim"] = Tim::where("user_id", Auth::user()->id)->first();

        return view('tim.index', $data);
    }

    public function post(Request $request)
    {
        Tim::where("user_id", Auth::user()->id)->update([
            "nama_tim" => $request->nama_tim
        ]);

        return back();
    }
}
