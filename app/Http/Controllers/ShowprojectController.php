<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ShowprojectController extends Controller
{
   public function show(Request $request)
   {
        $auth = Auth::id();
        if($auth){
            $mineid = Project::where('user_id', $auth)->first()
                ->toArray();
            $mineproject = ProjectContent::where('project_id', $mineid['id'])->first()->toArray();
            $mine = $mineproject['title'];
            }
        
        $releasedproject = Project::where('released', 1)->pluck('id')->toArray();
        foreach($releasedproject as $s){
            $value = ProjectContent::where('project_id', $s)
                                ->pluck('title', 'about')
                                ->toArray();
            $newproject = $value;
        }
             
        return view('showproject', compact('mine', 'newproject'));
    }
}
