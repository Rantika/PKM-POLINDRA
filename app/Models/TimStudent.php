<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TimStudent extends Model
{
    use HasFactory;
    protected $table='tim_student';
    protected $guarded = [];

    public function tim(){
        return $this->belongsTo('App\Models\Tim','tim_id','id');
    }

    public function student(){
        return $this->belongsTo('App\Models\Student','student_id','id');
    }
}
