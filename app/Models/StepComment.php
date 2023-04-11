<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StepComment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
