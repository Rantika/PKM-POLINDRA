<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['proposal'] = Proposal::with(['student', 'reviewer.lecturer', 'lecturer', 'scheme', 'comment'])
            ->where('student_id', Auth::user()->student->id)
            ->first();
        return view('tim.index', $data);
    }
}
