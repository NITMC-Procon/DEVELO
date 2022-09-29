<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    //
    public function viewer()
    {
        return view("contents.mypage");
    }
}
