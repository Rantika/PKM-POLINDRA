<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
    public function scheme(){
        return $this->belongsTo(Scheme::class);
    }
    public function comment(){
        return $this->hasOne(Comment::class);
    }
}