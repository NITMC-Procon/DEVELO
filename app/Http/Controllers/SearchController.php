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
            $Projects = [];

            $value1 = ProjectContent::where('project_id', 1)
                                    ->pluck('title', 'about')
                                    ->toArray();
            //$Projects[] = $value;
            $value2 = ProjectContent::where('project_id', 2)
                                    ->pluck('title', 'about')
                                    ->toArray();
        /*
            $Projects[] = [
                $value1,
                $value2
            ];
            dd($Projects);
*/
            foreach($releasedProjects as $s){
                $value = ProjectContent::where('project_id', $s)
                                    ->where('title', 'like', '%'.$search.'%')
                                    ->pluck('title', 'about')
                                    ->toArray();
                $Projects[] = $value;
            }
            
            //$Projects = [];
            //$Project = ProjectContent::where('id', '1')->get()->toArray();
            //$Projects[] = $Project;
            //$Project = ProjectContent::where('id', '2')->get()->toArray();
            //$Projects[] = $Project;
            dd($Projects);

           return  view('Search.res', compact('projects','search'));
        
        }

        return view('Search.Search');
    }
}