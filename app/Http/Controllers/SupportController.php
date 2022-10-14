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

class SupportController extends Controller
{
    //
    public function project(Request $request)
    {
        if(!Project::where('id',$request->id)->where('released',1)->exists())return abort('404','該当のプロジェクトは存在しません。');
        $project_data = [
            'title' => ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first()->title,
            'intro' => ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first()->intro,
            'created' => ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->oldest()->first()->released_at,
            'updated' => ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first()->released_at,
            'user_id' => Project::where('id',$request->id)->first()->user_id,
            'user_name' => User::where('id',Project::where('id',$request->id)->first()->user_id)->first()->name,
            'status' => Status::where('id',ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first()->status)->first()->status,

        ];

        $courses = Course::where('project_id',$request->id)->where('released',1)->get();

        $courses = isset($courses) ? $courses->toArray() : [] ;
        $course_data = [];

        foreach($courses as $n => $c){
            $course_data[$n] = [
                'id' => $c['id'],
                'title' => CourseContent::where('course_id',$c['id'])->whereNotNull('released_at')->latest()->first()->title,
                'return' => implode("、",json_decode(CourseContent::where('course_id',$c['id'])->whereNotNull('released_at')->latest()->first()->content,true)['file']),
            ];
        }


        /*
        $courses = Course::where('project_id',$request->id)->where('released',1)->get()->toArray();
        $return_text = [];
        foreach($courses as $n => $course){
            $courseContent = CourseContent::where('course_id',$course['id'])->whereNotNull('released_at')->latest()->first();
            $content = json_decode($courseContent->content);
            $return_text[$n] = $content['file'];
        }
        */
        return view('contents.project_viewer',compact('project_data','course_data'));
    }
}