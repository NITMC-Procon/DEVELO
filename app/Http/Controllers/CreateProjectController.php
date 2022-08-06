<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreateProjectController extends Controller
{
    //
    public function create(){
        $name = User::factory()->make([
        'name' => '小崎相様クンちゃん',
    ])['name'];
    $id = '1';
    $name = mb_strlen($name,'UTF-8')>8 ? mb_substr($name,0,4) . "…" : $name; 
    return view('create-project',['id'=>$id,'name'=>$name]);

    }
}
