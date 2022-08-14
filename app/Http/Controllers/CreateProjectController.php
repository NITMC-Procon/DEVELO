<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;

class CreateProjectController extends Controller
{
    //
    public function create(){
    return view('contents.create-project');

    }

    public function upload(Request $request)
    {
        $vaildatedData = $request->validate([
            'title' => 'required|max:20',
            'status' => 'integer|min:1|max:4',
            'about' => 'max:50',
            'intro' => 'max:100'
        ]);
        $project = array(
            'id' => Auth::user()->id,
            'title' => htmlspecialchars($request->title),
            'status' => $request->status,
            'about' => htmlspecialchars($request->about),
            'intro' => htmlspecialchars($request->intro)
        );

        $project_db = new Project();
        foreach($project as $key=>$value){
            $project_db->$key = $value;
        }


        return view('contents.save-project',compact('project'));

    }
}
