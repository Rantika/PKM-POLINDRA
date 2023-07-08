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

    public function mahasiswa()
    {
        return $this->belongsTo("App\Models\Student", "student_id", "user_id");
    }

    public function dosbing()
    {
        return $this->belongsTo("App\Models\Dosbing", "lecturer_id", "dosbing_id");
    }

    public function komentar()
    {
        return $this->hasMany("App\Models\Komentar", "proposal_id", "id");
    }

    public function mahasiswa_parent()
    {
        return $this->belongsTo("App\Models\User", "student_id", "id");
    }
}
