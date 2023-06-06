<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function post(Request $request, $id)
    {
        $cek = User::where("id", Auth::user()->id)->update([
            "id_hak_akses" => $id,
        ]);

        if ($cek) {
            echo 1;
        } else {
            echo 2;
        }
    }
}
