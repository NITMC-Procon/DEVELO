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
    public function manage(Request $request)
  {
    return view('contents.diary');
  }

}
/*$project_data = Project::where('id',$request->id)
                ->first();
    if($project_data->user_id != Auth::user()->id) return abort(403,'このプロジェクトをプレビューする権利がありません。');
    else{
        return view('contents.diary');
    }*/