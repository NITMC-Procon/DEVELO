<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsrController extends Controller
{
    //
    public function name(Request $request,$name){

        return view('test', ['name'=>$name]);

    }
}
