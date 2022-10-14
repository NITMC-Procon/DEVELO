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
use App\Models\CourseContent;

class CourseController extends Controller
{
    //
    public function create(Request $request)
    {
        if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを編集する権利がありません。');
        $data['title'] = ProjectContent::where('project_id',$request->id)->latest()->first()->title;
        $data['id'] = $request->id;
        return view('contents.create-course',compact('data'));
    }

    public function store(Request $request)
    {
        if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return ['stored'=>false,'error'=>'このプロジェクトのコースを作成することはできません。'];
        $content = json_decode($request->getContent(),true);
        if(empty($content['title']))return ['stored'=>false,'error'=>'タイトルが入力されていません。','content'=>$content];

        $reference_id = "".strlen(Auth::user()->id).Auth::user()->id.$content['date'];

        if(!Course::where('reference_id',$reference_id)->exists()){
            $course = new Course;
            $course->project_id = $request->id;
            $course->profile_acquired_json = json_encode($content['profile']);
            $course->reference_id = $reference_id;
            $course->save();
        }
        

        $course_content = new CourseContent;
        $course_content->content = json_encode($content['content']);
        $course_content->course_id = Course::where('project_id',$request->id)->latest()->first()->id;
        $course_content->title = $content['title'];
        $course_content->save();

        return ['stored' => true,'id'=>$request->id];
    }

    public function manage(Request $request)
    {
        if(empty($request->id)){
            $projects = Project::where('user_id',Auth::user()->id)->get();
            $project_attributes = [];

            foreach($projects as $n => $project){
                $project_attributes[$n]['title'] = ProjectContent::where('project_id',$project->id)->latest()->first()->title;
                $project_attributes[$n]['about'] = ProjectContent::where('project_id',$project->id)->latest()->first()->about;
            }

            $project_data = [];

            foreach($projects as $n=>$project){
                $project_data[$n] = [$project['id'],$project_attributes[$n]['title'],$project_attributes[$n]['about']];
            }
            return view('contents.manage-course',compact('project_data'));
        }else{
            if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort('403','このプロジェクトを操作する権利がありません');
            $courses = Course::where('project_id',$request->id)->get();
            $course_attributes = [];

            foreach($courses as $n => $course){
                $course_attributes[$n]['title'] = CourseContent::where('course_id',$course->id)->latest()->first()->title;

                $course_attributes[$n]['released'] = Course::where('id',$course->id)->first()->released;
            }

            $course_data = [];

            foreach($courses as $n=>$course){
                $course_data[$n] = [$course['id'],$course_attributes[$n]['title'],$course_attributes[$n]['released']];
            }
            $course_data['project_id']=$request->id;
            $course_data['project_title'] = ProjectContent::where('project_id',$request->id)->latest()->first()->title;
            return view('contents.manage-course-individual',compact('course_data'));
        }
        
    }
}
