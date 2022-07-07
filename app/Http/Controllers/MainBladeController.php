<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class MainBladeController extends Controller
{

    public function usr_data(){
        $name = User::factory()->make([
            'name' => '小崎相様クンちゃん',
        ])['name'];
        $id = '1';
        $name = mb_strlen($name,'UTF-8')>8 ? mb_substr($name,0,4) . "…" : $name; 
        return view('main',['id'=>$id,'name'=>$name]);
    }

}