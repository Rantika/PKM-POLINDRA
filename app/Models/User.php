<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function reviewer(){
        return $this->hasOne(Reviewer::class);
    }

    public function lecturer(){
        return $this->belongsTo("App\Models\Lecturer", "id", "user_id");
    }

    public function student(){
        return $this->hasOne(Student::class);
    }

    public function notification(){
        return $this->hasMany(Notification::class);
    }

    public function forum(){
        return $this->hasMany(Forum::class);
    }

    public function komentar(){
        return $this->hasMany(Komentar::class);
    }
    public function tim(){
        return $this->belongsTo('App\Models\Tim','id','user_id');
    }

    public function usersrole()
    {
        return $this->belongsTo("App\Models\UsersRole", "id", "user_id");
    }

    public function hak_akses()
    {
        return $this->belongsTo("App\Models\UsersRole", "id_hak_akses", "id");
    }
}
