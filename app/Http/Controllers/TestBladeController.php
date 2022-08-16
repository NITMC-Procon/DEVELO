<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TestBladeController extends Controller
{

    public function __invoke()
    {
        return view("test");
    }

}