<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectContent;
use Illuminate\Http\Request;
use App\Models\ProjectIcon;

class MainBladeController extends Controller
{

    public function usr_data(Request $request){
        $search = $request->search;
        $searchable_project_ids = Project::where('released',1)->pluck('id')->toArray();
        
        $myprojects = [];
        $latestprojects = [];

        foreach($searchable_project_ids as $n => $id){
            $latest_content = ProjectContent::where('project_id',$id)->whereNotNull('released_at');
            if($latest_content->first() == null)continue;
            $latest_content = $latest_content->where('user_id',Auth::user()->id)->latest()->first(['project_id','title','about','user_id']);
            $latestprojects[$n] = $latest_content->toArray();
            $latestprojects[$n]['icon'] = $latestprojects[$n]['project_id'].".".ProjectIcon::where('project_id',$latestprojects[$n]['project_id'])->first()->extension;
            if($latest_content['user_id'] == Auth::user()->id){
                $myprojects[$n] = $latestprojects[$n];
            }
            
            
        }
        return view('contents.main',compact('latestprojects','myprojects'));
    }

}