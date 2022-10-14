<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    //
    public function viewer()
    {
        $profile = Profile::where('user_id',Auth::user()->id)->first()->toArray();
        return view('contents.store-profile',compact('profile'));
    }

    public function store(Request $request)
    {
        $profiles = $request->validate([
            'name' => 'required',
            'gender' => 'in:男,女,その他|nullable',
            'address' => 'nullable',
            'yearsold' => 'nullable' 
        ]);

        $profile = Profile::where('user_id',Auth::user()->id)->first();
        $profile->name = $request->name;
        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->yearsold = $request->yearsold;
        $profile->save();

        $user = User::where('id',Auth::user()->id)->first();
        $user->name = $request->name;
        $user->save(); 

        return redirect('/');
    }
}
