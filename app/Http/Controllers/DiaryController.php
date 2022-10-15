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
use App\Models\Diary;
use App\Models\Course;

class DiaryController extends Controller
{
  public function update(Request $request)
    {
        if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを編集する権利がありません。');

        $project_diary = ProjectContent::where('project_id',$request->id)
                ->latest()
                ->first();
        $project = Project::where('id',$request->id)->first();
        $project_diary = $project_diary->toArray();
        $project_diary['date'] = substr(Project::where('id',$request->id)->first()->reference_id,-13);

        return view('contents.update-diary',compact("project_diary"));
    }
    public function upload(Request $request)
    {
        $vaildatedData = $request->validate([
            'title' => 'required|max:40',
            'text' => 'max:10000',
        ]);
        
        $GLOBALS['date'] = $request->date;
        $GLOBALS['id']=Auth::user()->id;
        $reference_id = "".strlen($GLOBALS['id']).$GLOBALS['id'].$GLOBALS['date'];

        //新規作成

        $project = new Diary();
        $project -> project_id=Auth::user()->id;
        $project->title = htmlspecialchars($vaildatedData['title']);
        $project->text = $vaildatedData['text']===null ? "" : htmlspecialchars($vaildatedData['text']);
        $project->save();
        return redirect(route('admin.diary.manage'));

  }

  public function create(Request $request)
    {
        return view('contents.create-diary');
    }

    public function managedetail(Request $request){
        $diaries = Diary::where('project_id',$request->id)->get();//問題
        $diary_attributes = [];

        foreach($diaries as $n => $project){
            $diary_attributes[$n]['title'] = Diary::where('project_id',$project->id)->latest()->first()->title;
        }

        $diary_data = [];

        foreach($diaries as $n=>$project){
            $diary_data[$n] = [$project['id'],$diary_attributes[$n]['title']];
        }
        //$diary_data['project_id']=$request->id;
        return view('contents.diary-detail',compact('diary_data'));
        
    }

    public function manage(Request $request)
    {
        $projects = Project::where('user_id',Auth::user()->id)->get();
        $project_attributes = [];

        foreach($projects as $n => $project){
            $project_attributes[$n]['title'] = ProjectContent::where('project_id',$project->id)->latest()->first()->title;

            $project_attributes[$n]['released'] = Project::where('id',$project->id)->latest()->first()->released;
        }

        $diary_data = [];

        foreach($projects as $n=>$project){
            $diary_data[$n] = [$project['id'],$project_attributes[$n]['title'],$project_attributes[$n]['released']];
        }
            return view('contents.diary',compact('diary_data'));
            
        }

}
/*$project_data = Project::where('id',$request->id)
                ->first();
    if($project_data->user_id != Auth::user()->id) return abort(403,'このプロジェクトをプレビューする権利がありません。');
    else{
        return view('contents.diary');
    }*/