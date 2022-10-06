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

class CourseController extends Controller
{
    //
    public function create(Request $request)
    {
        if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを編集する権利がありません。');
        return view('contents.create-course',['id'=>$request->id]);
    }
}
