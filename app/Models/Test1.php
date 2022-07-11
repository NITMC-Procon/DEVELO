<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test1 extends Model
{
    use HasFactory;
    protected $guarded = ['create_at', 'update_at'];
}
