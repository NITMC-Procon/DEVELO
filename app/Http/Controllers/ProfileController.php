<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{

    public function insertRecord(Request $request)
    {
        $profile = new Profile();
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->save();
        return redirect('/');
    }

}
