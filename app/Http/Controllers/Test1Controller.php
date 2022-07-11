<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test1;

class Test1Controller extends Controller
{
    public function yamato(Request $request)
    {
        $test1 = new Test1();
        $test1->name = $request->name;
        $test1->age = $request->age;
        $test1->any = $request->any;
        $test1->save();
        return redirect('/');
    }
}