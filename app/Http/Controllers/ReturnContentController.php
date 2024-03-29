<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReturnContent;
use App\Models\Project;
use App\Models\Course;
use App\Models\Support;
use Illuminate\Support\Facades\Storage;

class ReturnContentController extends Controller
{
    //
    public function store(Request $request)
    {
        $project_id = Course::where('id',$request->id)->first()->project_id;
        if(!Project::where('id',$project_id)->where('user_id',Auth::user()->id)->exists())return ['completed'=>false,'message'=>'このプロジェクトのリターンは設定出来ません。'];
        $reference_id = "" . strlen(Auth::user()->id) . Auth::user()->id . $request->date;
        foreach($request->file() as $file){
            if(!ReturnContent::where('reference_id',$reference_id)->where('name',$file->getClientOriginalName())->exists()){
                $return_content = new ReturnContent;
                $return_content->reference_id = $reference_id;
                $return_content->course_id = $request->id;
                $return_content->name = $file->getClientOriginalName();
                $return_content->save();
                Storage::putFileAs('/return/',$file,$return_content->id.'.'.pathinfo($return_content->name,PATHINFO_EXTENSION));
                }
        }
    return ['completed'=>true,'message'=>'ok'];
    }

    public function receive(Request $request)
    {
        $id = $request->id;

        if(Support::where('course_id',$id)->where('supported_by',Auth::user()->id)->exists()){
            return Storage::disk('local')->download('return/1.png');;
        }
        
    }

    private function downloader($id)
    {
        $content = ReturnContent::where('course_id',$id)->get();
            foreach($content->toArray() as $n => $c){
                Storage::disk('local')->download('return/'.$c['id'].".".pathinfo($c['name'],PATHINFO_EXTENSION),$c['name']); 
            }
    }
}
