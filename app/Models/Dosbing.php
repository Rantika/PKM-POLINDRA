<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosbing extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'dosbing';

    public function lecturer(){
        return $this->belongsTo("App\Models\Lecturer", "dosbing_id", "id");
    }

    public function prody(){
        return $this->belongsTo(Prody::class);
    }

    public function proposal(){
        return $this->hasMany(Proposal::class);
    }

    public function student(){
        return $this->belongsTo("App\Models\Student", "student_id", "user_id");
    }
}
