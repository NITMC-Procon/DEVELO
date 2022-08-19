<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test2 extends Model
{
    public function tests(){
        return $this->belongsTo('App\Models\Test');
    }
}
