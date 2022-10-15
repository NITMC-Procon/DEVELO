<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectContent;
use Illuminate\Http\Request;
use App\Models\ProjectIcon;

class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $search = $request->search;
        $searchable_project_ids = Project::where('released',1)->pluck('id')->toArray();
        
        $projects = [];

        foreach($searchable_project_ids as $n => $id){
            $latest_id = ProjectContent::where('project_id',$id)->whereNotNull('released_at')->latest()->first()->id;
            $latest_content =ProjectContent::where('id',$latest_id)->where('title', 'like', "%$search%")->first(['project_id','title','about']);
            if($latest_content == null)continue;
            $projects[$n] = $latest_content->toArray();
            $projects[$n]['icon'] = $projects[$n]['project_id'].".".ProjectIcon::where('project_id',$projects[$n]['project_id'])->first()->extension;
            
            
        }

        return view('Search.Search',compact('projects','search'));

    }
}