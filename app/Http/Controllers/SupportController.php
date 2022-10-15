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
            'intro' => $this->createViewFromText(ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first()->intro),
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

    private function createViewFromText($text)
    {
        #/-img:(---):img text:hello:text-/のように書かれた内容を表示する。

        #テキスト中の改行をbrタグに変換
        #正規表現パターン url,text,img,colorに対応
        $regex = '|/- *((url:.*?:url *)?(text:.*?:text *)?(img:.*?:img *)?(color:.*?:color *)? *)+? *-/|';
        #regexとマッチしている部分をmatchesに取得 ここでは/--/で囲まれ、url,text,img,colorいずれかを含むものを取り出す
        preg_match_all($regex,$text,$matches,2);

        #matches内の各要素について、要素名と全体の何番目かをattributesに取り出す
        $attributes = [];
        foreach($matches as $outer_key => $outer_value){
            foreach($outer_value as $key => $value){
                if($key == 0)continue;
                $regex_attributes = '|:(.+):|';
                preg_match($regex_attributes,$value,$container);
                #全体の中の番号と、「:」より前の文字(要素名)をkeyに、要素を格納する。右辺は空のarrayの対策
                $attributes[$outer_key][mb_strstr($value,':',true)] = $container[1] ?? NULL;
            }
        }
        #/--/で囲まれていない部分を取得
        $splited_texts_array = preg_split($regex,$text);
        #HTMLを作成
        $result_html = "<p style='display'>";
        foreach($splited_texts_array as $index => $value){
            $result_html .= htmlspecialchars($value).(array_key_exists($index,$attributes) ? $this->convertTextToHtml($attributes,$index): "");
        }
        $result_html .= "</p>";
        
        return nl2br($result_html);
    }

    private function convertTextToHtml($attributes,$n)
    {
        #テキストからHTMLに変換する
        #初期化
        $url_exist = array_key_exists('url',$attributes[$n]);
        $clr_exist = array_key_exists('color',$attributes[$n]);
        $img_exist = array_key_exists('img',$attributes[$n]);
        $txt_exist = array_key_exists('text',$attributes[$n]);
        $url = $url_exist ? htmlspecialchars($attributes[$n]['url']) : "";
        $color = $clr_exist ? htmlspecialchars($attributes[$n]['color']) : "";
        $text = $txt_exist ? htmlspecialchars($attributes[$n]['text']) : "";
        $img = $img_exist ? $attributes[$n]['img'] : "";
        $img_info = $img_exist ? mb_strstr($img,".") :"";
        $img = $img_exist ? Image::where('referenced_by',"".strlen($GLOBALS['id']).$GLOBALS['id'].$GLOBALS['date'])
                            ->where('name',$img)
                            ->first()['id']
                            : "";
        $img = $img_exist ? url("storage/img/images/".$img.$img_info) : "";
 

        if($img_exist){
            $converted = 
                "<br>".
                "<img src=\"{$img}\"".
                ($txt_exist ? "alt=\"{$text}\"" : "").
                " style=\"max-width:40%;\">".
                "<br>"
            ;
            return $converted;
        }
        else{
            $converted =
                ($url_exist ? "<a href=\"{$url}\" >" : "").
                "<span ".($clr_exist ? "style=\"color: $color;\">" : ">").
                ($txt_exist ? $text : "").
                "</span>".
                ($url_exist ? "</a>" : "")
            ;
        
            return $converted;
        }
    }
}