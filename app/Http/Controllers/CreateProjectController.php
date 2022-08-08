<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreateProjectController extends Controller
{
    //
    public function create(){
    return view('contents.create-project');

    }
}
