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
            $mine = ProjectContent::where('project_id', $mineid['id'])->first()->toArray();  
        }
            
        $releasedproject = Project::latest()->where('released', 1)->pluck('id')->toArray();
        $num = 0;

        foreach($releasedproject as $s){
            $value = ProjectContent::where('project_id', $s)
                                ->get()
                                ->toArray();

            if($num < 5){
                $newproject[] = $value;
            }
            $num = count($newproject);
        }
        $num = count($newproject);
            for($i = 0; $i < $num; $i++){
                $many[] = $i;
            }
        if($mine){
            return view('showproject', compact('mine', 'newproject', 'many'));
        }
        else{ 
            return view('showproject', compact('newproject', 'many'));
    }
    }
}