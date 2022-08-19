<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function Test(Request $request){
        $Test =new Test();
        $Test -> title = $request -> title;
        $Test -> body = $request -> body;
        $Test -> save();
        return redirect('/');
    }
}
