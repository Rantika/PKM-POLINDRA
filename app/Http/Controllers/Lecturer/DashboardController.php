<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $data['proposal'] = Proposal::where('lecturer_id', Auth::user()->lecturer->id)->get();

        return view('dosbing.index', $data);
    }

    public function indexReviewer()
    {
        $data['proposal'] = Proposal::where('reviewer_id', Auth::user()->lecturer->reviewer->id)->get();

        return view('reviewer.index', $data);
    }
}
