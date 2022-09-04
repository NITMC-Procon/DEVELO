<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Image;
class ProjectController extends Controller
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
            'intro' => 'max:1000',
        ]);
        
        $GLOBALS['date'] = $request->date;
        $GLOBALS['id']=Auth::user()->id;

        $project_db = new Project();
        $project_db->title = htmlspecialchars($vaildatedData['title']);
        $project_db->status = $vaildatedData['status'];
        $project_db->about = htmlspecialchars($vaildatedData['about']);
        $project_db->intro = $vaildatedData['intro'];
        $project_db->intro_converted = $this->createViewFromText($vaildatedData['intro']);
        $project_db->user_id = Auth::user()->id;
        $project_db->reference_id = "".strlen($GLOBALS['id']).$GLOBALS['id'].$GLOBALS['date'];
        $project_db->save();

        $latest_project_id = Project::where('user_id',Auth::user()->id)
                            ->latest()
                            ->get('id');
        


        return redirect('/preview_project/'.$latest_project_id[0]['id']);

  }
  public function previewInCreating(Request $request)
  {
    $vaildated = $request->validate([
        'intro'=>'max:1000'
    ]);

    $GLOBALS['date'] = $request->referenced;
    $GLOBALS['id']=Auth::user()->id;

    return $this->createPreview($request->intro);
  }

  public function preview(Request $request)
  {
    $project_data = Project::where('id',$request->id)
                ->get();
    $project_data = $project_data->toArray();
    $project_data = $project_data[0];
    if($project_data['user_id'] != Auth::user()->id) return abort(403,'You don\'t have permission to preview this project.');
    else{
        return view('contents.preiew_project',compact("project_data"));
    }
  }

  private function createPreview($text){
    return $this->createViewFromText($text);
  }

  private function createViewFromText($text)
    {
        #/-img:(---):img text:hello:text-/のように書かれた内容を表示する。

        #テキスト中の改行をbrタグに変換
        $text = nl2br($text);
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
        $result_html = "<p>";
        foreach($splited_texts_array as $index => $value){
            $result_html .= htmlspecialchars($value).(array_key_exists($index,$attributes) ? $this->convertTextToHtml($attributes,$index): "");
        }
        $result_html .= "</p>";
        
        return $result_html;
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
        $img = $img_exist ? url("storage/images/".$img.$img_info) : "";

        if($img_exist){
            $converted = 
                "<br>".
                ($url_exist ? "<a href=\"{$url}\" >" : "").
                "<img src=\"{$img}\"".
                ($txt_exist ? "alt=\"{$text}\"" : "").
                " style=\"max-width:40%;\">".
                ($url_exist ? "</a>" : "").
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
