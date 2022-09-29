<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class MainBladeController extends Controller
{

    public function usr_data(){
        return view('contents.main');
    }

}