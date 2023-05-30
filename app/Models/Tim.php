<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table='tim';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo("App\Models\Student", "user_id", "user_id");
    }

    public function proposal()
    {
        return $this->belongsTo("App\Models\Proposal", "user_id", "student_id");
    }
}

