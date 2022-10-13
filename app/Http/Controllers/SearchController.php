<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectContent;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $releasedProjects = Project::where('released', 1)->pluck('id')
                                                        ->toArray();
    
        $search = $request->search;
    
        $projects = ProjectContent::where('project_id', $releasedProjects)
           ->where('title', 'like', '%'.$search.'%')->get();
            
    
        return  view('Search.Search', compact('projects','search'));
    }
}