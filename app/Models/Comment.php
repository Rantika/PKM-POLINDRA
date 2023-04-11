<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }
    public function step(){
        return $this->belongsTo(StepComment::class);
    }
}
