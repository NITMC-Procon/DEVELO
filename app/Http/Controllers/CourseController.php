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
            $course->user_id = Auth::user()->id;
            $course->save();
        }
        

        $course_content = new CourseContent;
        $course_content->content = json_encode($content['content']);
        $course_content->course_id = Course::where('project_id',$request->id)->latest()->first()->id;
        $course_content->title = $content['title'];
        $course_content->save();

        return ['stored' => true,'id'=>$request->id];
    }

    public function update(Request $request)
    {
        if(!Course::where('id',$request->course_id)->where('user_id',Auth::user()->id)->exists)return abort(403,'このコースを編集する権利がありません。');

        
        return view('/');
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
            if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを操作する権利がありません');
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

    public function setRelease(Request $request)
    {
        if(!Course::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort('403','このコースを操作する権利がありません');
        $project_id = Course::where('id',$request->id)->first()->project_id;
        $data['project'] = ProjectContent::where('project_id',$project_id)->whereNotNull('released_at')->first()->title;
        $data['course'] = CourseContent::where('course_id',$request->id)->latest()->first()->title;
        $data[0] = $request->id;
        $data[1] = CourseContent::where('course_id',$request->id)->latest()->first()->title;
        $data[2] = $this->isReleasable(json_decode(CourseContent::where('course_id',$request->id)->latest()->first()->content,true));
        $data[3] = Course::where('id',$request->id)->first()->released;

        return view('contents.release-course',compact('data'));
    }

    public function release(Request $request)
    {
        if(!Course::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort('403','このコースを操作する権利がありません');
        $course = Course::where('id',$request->id)
                    ->first();
        $course_content = CourseContent::where('course_id',$request->id)->latest()->first();
        $course->update(['released' => true]);
        if(empty($course_content->released_at))$course_content->update(['released_at' => date('Y-m-d H:i:s',time())]);
        return redirect(route('admin.course.manage',['id'=>$request->id]));
        
    }



    private function isReleasable($sequense)
    {
        if(empty($sequense) && is_array($sequense))return false;
        else if(!is_array($sequense)){
            if(!empty($sequense) || $sequense === false)return true;
            return false;
        }
        foreach($sequense as $n => $s1){
            if(!$this->isReleasable($s1))return false;
        }return true;
    }
}
