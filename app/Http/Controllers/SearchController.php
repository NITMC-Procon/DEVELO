<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectContent;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $search = $request->search;
        if($search !== null){
        $releasedProjects = Project::where('released', 1)->pluck('id')
                                                        ->toArray();
    
        $projects = ProjectContent::where('project_id', $releasedProjects)
           ->where('title', 'like', '%'.$search.'%')->get()->toArray();
        return  view('Search.res', compact('projects','search'));
        }

        return view('Search.Search');
    }
}