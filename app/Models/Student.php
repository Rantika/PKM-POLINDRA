<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function prody(){
        return $this->belongsTo(Prody::class);
    }
    public function proposal(){
        return $this->hasOne(Proposal::class);
    }
    public function bimbingan(){
        return $this->hasMany(Bimbingan::class);
    }
    public function forum(){
        return $this->hasMany(Forum::class);
    }
}
