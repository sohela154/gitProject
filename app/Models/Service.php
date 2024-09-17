<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public function categoriesInfo(){
        return $this->belongsTo('App\Models\Category','category_id','categories_id');
    }
}
