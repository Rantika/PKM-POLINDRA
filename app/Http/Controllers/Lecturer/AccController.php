<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Dosbing;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccController extends Controller
{
    public function index()
    {
        $data = [
            "proposals" => Proposal::where("lecturer_id", Auth::user()->lecturer->id)->get()
        ];

        return view("dosbing.acc.index", $data);
    }

    public function update(Request $request, $id)
    {
        Dosbing::where("id", $id)->update([
            "status" => $request->status
        ]);

        return back();
    }
}
