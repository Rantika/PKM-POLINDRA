<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prody;
use App\Models\Period;
use App\Models\Scheme;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Tim;
use App\Models\UsersRole;
use App\Models\ViewConf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $data['configs'] = ViewConf::get();
        return view('auth.login', $data);
    }

    public function authenticate(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            
            User::where("id", Auth::user()->id)->update([
                "id_hak_akses" => Auth::user()->usersrole->id
            ]);

            if (Auth::user()->usersrole->role == "Admin") return redirect()->route("dashboard");
            $activePeriod = Period::where('is_active', true)->first();
            if(!$activePeriod){
                return redirect()->back()->with('error', 'Tidak bisa login karena periode PKM telah selesai/Tidak ada periode PKM yang berlangsung!');
            }

            if (Auth::user()->usersrole->role == "Dosen Pembimbing") return redirect()->route("lecturer.index");
            if (Auth::user()->usersrole->role == "Student") return redirect()->route("student.index");
            if (Auth::user()->usersrole->role == "Lecturer") return redirect()->route("lecturer.index");
            
        }else{
            return redirect()->back()->with('error', 'Email atau Password yang anda masukkan salah!');
        }
    }

    public function register()
    {
        $activePeriod = Period::where('is_active', true)->first();
        if(!$activePeriod){
            return redirect()->back()->with('error', 'Tidak bisa mendaftar karena periode PKM telah selesai/Tidak ada periode PKM yang berlangsung!');
        }

        $data['schemes'] = Scheme::get();
        $data['prodies'] = Prody::get();
        $data['lecturers'] = Lecturer::get();

        return view('auth.register', $data);
    }

    public function creating(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
            ]);

            $student = Student::create([
                'user_id'       => $user->id,
                'prody_id'      => $request->prody_id,
                'name'          => $request->name,
                'nim'          => $request->nim,
                'phone_number'  => $request->phone_number,
            ]);

            $role = UsersRole::create([
                "user_id" => $user->id,
                "role" => "Student"
            ]);

            User::where("id", $user->id)->update([
                "id_hak_akses" => $role->id
            ]);
                
            $tim = Tim::create([
                "user_id" => $user->id
            ]);
            
            $param = [
                'id'            => $role->id,
                'for'           => 'admin',
                'type'          => 0,
                'description'   => $student->name,
            ];
            
            NotificationController::create($param);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $request);
            return redirect()->back()->with('error', 'Internal server Error!');
        }

        Auth::loginUsingId($user->id); // loginUsingId :
        return redirect()->route('student.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken(); // regenerateToken :

        return redirect()->route('login');
    }
}
