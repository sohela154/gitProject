<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    public function serviceInfo(){
        return $this->belongsTo('App\Models\Service','service_id','service_id');
    }
}
