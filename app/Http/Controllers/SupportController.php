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
        $projectContent = ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first();

        $courses = Course::where('project_id',$request->id)->where('released',1)->get()->toArray();
        $return_text = [];
        foreach($courses as $n => $course){
            $courseContent = CourseContent::where('course_id',$course['id'])->whereNotNull('released_at')->latest()->first();
            $content = json_decode($courseContent->content);
            $return_text[$n] = $content['file'];
        }
        
    }
}