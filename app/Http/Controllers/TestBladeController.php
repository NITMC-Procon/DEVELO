<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourseContent;

class TestBladeController extends Controller
{

    public function view()
    {
        dd(json_decode(CourseContent::first()->content));
    }

}