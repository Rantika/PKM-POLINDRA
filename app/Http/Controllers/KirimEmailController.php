<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CobaNgodingEmail;
use Illuminate\Support\Facades\Mail;

class KirimEmailController extends Controller
{
    public function index()
    {
        $data = [
            'name' => 'Syahrizal As',
            'body' => 'Testing Kirim Email di Santri Koding'
        ];
        
        Mail::to("testing@malasngoding.com")->send(new CobaNgodingEmail($data));
 
		return "Email telah dikirim";
    }
}
