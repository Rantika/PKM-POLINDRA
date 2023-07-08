<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = "komentar";

    protected $guarded = [''];

    public function lecturer()
    {
        return $this->belongsTo("App\Models\Lecturer", "user_id", "id");
    }

    public function childs()
    {
        return $this->hasMany("App\Models\Komentar", "parent", "id");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}
