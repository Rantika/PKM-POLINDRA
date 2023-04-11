<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prody extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function reviewer(){
        return $this->hasMany(Reviewer::class);
    }

    public function lecturer(){
        return $this->hasMany(Lecturer::class);
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
