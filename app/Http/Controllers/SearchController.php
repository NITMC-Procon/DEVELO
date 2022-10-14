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
            $project = ProjectContent::query();
            $releasedProjects = Project::query();
            $releasedProjects = Project::where('released', 1)->pluck('id')
                                                        ->toArray();
            
        
            foreach($releasedProjects as $s){
                $value = ProjectContent::where('project_id', $s)
                                    ->where('title', 'like', '%'.$search.'%')
                                    ->get()
                                    ->toArray();
                $Projects[] = $value;
            }
            $num = count($Projects);
            for($i = 0; $i < $num; $i++){
                $many[] = $i;
            }
            dd($Projects);
           return  view('Search.res', compact('Projects', 'many'));
        
        }

        return view('Search.Search');
    }
}