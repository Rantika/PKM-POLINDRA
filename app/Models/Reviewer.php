<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviewer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }

    public function prody(){
        return $this->belongsTo(Prody::class);
    }

    public function proposal(){
        return $this->hasMany(Proposal::class);
    }
}
