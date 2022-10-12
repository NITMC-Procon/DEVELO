<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Image;
use App\Models\Score;
use App\Models\Status;
use App\Models\ProjectContent;
use App\Models\Course;

class DiaryController extends Controller
{
  public function manage(){//プロジェクトのidによる管理
    $projects = Project::where('user_id',Auth::user()->id)->get();
    $project_attributes = [];

    foreach($projects as $n => $project){
        $project_attributes[$n]['title'] = ProjectContent::where('project_id',$project->id)->latest()->first()->title;

        $project_attributes[$n]['released'] = Project::where('id',$project->id)->latest()->first()->released;
    }

    $projects_diary = [];

    foreach($projects as $n=>$project){
        $projects_diary[$n] = [$project['id'],$project_attributes[$n]['title'],$project_attributes[$n]['released']];
    }
    return view('contents.diary',compact('projects_diary'));
  }
  public function update(Request $request)
    {
        if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを編集する権利がありません。');

        $project_diary = ProjectContent::where('project_id',$request->id)
                ->latest()
                ->first();
        $project = Project::where('id',$request->id)->first();
        $project_diary = $project_diary->toArray();
        $project_diary['date'] = substr(Project::where('id',$request->id)->first()->reference_id,-13);

        return view('contents.update_diary',compact("project_diary"));
    }

}
/*$project_data = Project::where('id',$request->id)
                ->first();
    if($project_data->user_id != Auth::user()->id) return abort(403,'このプロジェクトをプレビューする権利がありません。');
    else{
        return view('contents.diary');
    }*/