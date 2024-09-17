<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public function reviewInfo(){
        return $this->belongsTo('App\Models\User','reviewed_by','id');
    }
}
