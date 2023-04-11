<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $guarded=['id'];
    use HasFactory;
    protected $table='komentar';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function forum(){
        return $this->belongsTo(Forum::class);
    }

    public function childs(){
        return $this->hasMany(Komentar::class, 'parent');
    }
}
