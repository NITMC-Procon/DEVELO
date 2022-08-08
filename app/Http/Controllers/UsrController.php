<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsrController extends Controller
{
    //
    public function menu(){

        return view('contents.user-menu');

    }
}
