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
class ProjectController extends Controller
{
    //

    public function create(){
    return view('contents.create-project');

    }

    public function update(Request $request)
    {
        if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを編集する権利がありません。');

        $project_data = ProjectContent::where('project_id',$request->id)
                ->latest()
                ->first();
        $project = Project::where('id',$request->id)->first();
        $project_data = $project_data->toArray();
        $project_data['date'] = substr(Project::where('id',$request->id)->first()->reference_id,-13);

        return view('contents.update_project',compact("project_data"));
    }

    public function upload(Request $request)
    {
        $vaildatedData = $request->validate([
            'title' => 'required|max:40',
            'status' => 'integer|min:0|max:4',
            'project-icon' => 'mimes:png,jpg,jpeg',
            'about' => 'max:200',
            'intro' => 'max:5000',
        ]);
        
        $GLOBALS['date'] = $request->date;
        $GLOBALS['id']=Auth::user()->id;
        $reference_id = "".strlen($GLOBALS['id']).$GLOBALS['id'].$GLOBALS['date'];

        //すでに登録されていたらアップデート
        if(Project::where('reference_id',$reference_id)->exists()){
            $project = new ProjectContent();
            $project->title = htmlspecialchars($vaildatedData['title']);
            $project->status = $vaildatedData['status'];
            $project->about = $vaildatedData['about']===null ? "" : htmlspecialchars($vaildatedData['about']);
            $project->intro = $vaildatedData['intro']===null ? "" : htmlspecialchars($vaildatedData['intro']);
            $project->project_id = Project::where('reference_id',$reference_id)->first()->id;
            $project->save();

            $project_id = Project::where('reference_id',$reference_id)
                            ->first()->id;
        }
        //まだ登録されていなかったら新規作成
        else{
            $project_db = new Project();
            $project_db->user_id = Auth::user()->id;
            $project_db->reference_id = $reference_id;
            $project_db->save();

            $project_id = Project::where('reference_id',$reference_id)
                            ->first('id')['id'];

            $project = new ProjectContent();
            $project->title = htmlspecialchars($vaildatedData['title']);
            $project->status = $vaildatedData['status'];
            $project->about = $vaildatedData['about']===null ? "" : htmlspecialchars($vaildatedData['about']);
            $project->intro = $vaildatedData['intro']===null ? "" : htmlspecialchars($vaildatedData['intro']);
            $project->project_id = $project_id;
            $project->save();

            

            $project_score = new Score();
            $project_score->project = $project_id;
            $project_score->save();
        }
        

        return redirect(route('admin.project.manage'));

  }

  public function setRelease(Request $request)
  {
    if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを操作する権限がありません。');
    $project = Project::where('id',$request->id)
                ->first();
    if(!$this->isReleasable($request->id))$data['releasable'] = false;
    else $data['releasable'] = true;
    $data['released'] = $project->released;
    $project_content = ProjectContent::where('project_id',$request->id)->latest()->first();
    $data['id'] = $request->id;
    $data['title'] = $project_content->title;
    
    return view('contents.release-project',compact('data'));
  }

  public function release(Request $request)
  {
    if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを操作する権限がありません。');
    $project = Project::where('id',$request->id)
                ->first();
    $project_content = ProjectContent::where('project_id',$request->id)->latest()->first();
    if(!$this->isReleasable($request->id)){
        return redirect(route('admin.project.update',['id'=>$request->id]))->with('message','内容が不十分です');
    }
    else{
        $project->update(['released' => true]);
        if(empty($project_content->released_at))$project_content->update(['released_at' => date('Y-m-d H:i:s',time())]);
        return redirect(route('admin.project.manage'));
    }
  }

  public function private(Request $request)
  {
    if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを操作する権限がありません。');
    $project = Project::where('id',$request->id)
                ->first();
    $project->update(['released' => false]);;
    return redirect(route('admin.project.manage'));
  }

  public function manage(){
    $projects = Project::where('user_id',Auth::user()->id)->get();
    $project_attributes = [];

    foreach($projects as $n => $project){
        $project_attributes[$n]['title'] = ProjectContent::where('project_id',$project->id)->latest()->first()->title;

        $project_attributes[$n]['released'] = Project::where('id',$project->id)->latest()->first()->released;
    }

    $projects_data = [];

    foreach($projects as $n=>$project){
        $projects_data[$n] = [$project['id'],$project_attributes[$n]['title'],$project_attributes[$n]['released']];
    }
    return view('contents.manage-project',compact('projects_data'));
  }

  public function releaseUpdate(Request $request)
  {
    if(!Project::where('id',$request->id)->where('user_id',Auth::user()->id)->exists())return abort(403,'このプロジェクトを操作する権限がありません。');
    $project = Project::where('id',$request->id)
                ->first();
    $released_project_content_id = ProjectContent::where('project_id',$request->id)->whereNotNull('released_at')->latest()->first()->id;
    $latest_project_content = ProjectContent::where('project_id',$request->id)->latest()->first();
    if($released_project_content_id == $latest_project_content->id)$data['latest'] = true;
    else $data['latest'] = false;
    if(!$this->isReleasable($request->id))$data['releasable'] = false;
    else $data['releasable'] = true;
    $data['title'] = $latest_project_content->title;
    $data['id'] = $request->id;

    return view('contents.release-updated-project',compact('data'));


  }

  public function previewInCreating(Request $request)
  {
    $vaildated = $request->validate([
        'intro'=>'max:5000'
    ]);

    $GLOBALS['date'] = $request->referenced;
    $GLOBALS['id']=Auth::user()->id;

    return ['intro' => $this->createPreview($request->intro)];
  }

  public function preview(Request $request)
  {
    $project_data = Project::where('id',$request->id)
                ->first();
    if($project_data->user_id != Auth::user()->id) return abort(403,'このプロジェクトをプレビューする権利がありません。');
    else{
        return view('contents.preiew_project',compact("project_data"));
    }
  }

  public function view(Request $request)
  {
    if($request->isMethod('post')){
        $GLOBALS['date'] = $request->referenced;
        $GLOBALS['id']=Auth::user()->id;

        $data = array('title' => isset($request->title) ? $request->title :  "設定されていません",
                      'status' => $request->status != 0 ? Status::where('id',$request->status)->first()['status']
                                                        : "未選択",
                      'user' => Auth::user()->name,
                      'userId' => Auth::user()->id,
                      'created' => "YYYY-MM-DD",
                      'updated' => "YYYY-MM-DD",
                      'intro' => isset($request->intro) ? $this->createPreview($request->intro) : "入力されていません"
        );
        

        $view = '
                    <div style="display: flex;">
                        <div style="text-align:center;align-items:center;zoom:50%;width:100%;border:1px solid black;">
                            <div style="border-bottom: 2px solid black;">
                                <h1 style="width:80%;margin:0 auto;word-wrap:break-word;">'.$data['title'].'</h1>
                                <div style="display:inline-flex;">
                                    <p style="display:inline-block;color:#AAA;font-size:0.7rem;width:auto;margin-top:auto;margin-bottom:auto;margin-right:1rem;">
                                        公開日 '.$data['created'].' 最新の編集 '.$data['updated'].'
                                    </p>
                                    <p style="margin-right:1rem;">
                                        開発状況 <span style="font-weight: bold;">'.$data['status'].'</span>
                                    </p>
                                    <a href="http://localhost/profile/view/1" style="display:inline-block;text-decoration:none;align-items:center;">
                                        <img src='.url('storage/img/user-icon/'.Auth::user()->id.'.png').' style="height:1rem;padding-right:0.2rem;vertical-align:middle;"><span>'.Auth::user()->name.'</span> 
                                    </a>
                                </div>
                            </div>
                            <p style="margin:0 auto;width:80%;word-wrap:break-word;overflow:auto;">
                                '.$data['intro'].'
                            </p>
                        </div>
                    </div>
                ';
    }

    return ['view'=>$view];
  }

  private function createPreview($text){
    return $this->createViewFromText($text);
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

    private function isReleasable($id){
        $project_content = ProjectContent::where('project_id',$id)->latest()->first();

        if(
            empty($project_content->title) or
            empty($project_content->about) or
            $project_content->status == 0  or
            empty($project_content->intro) 
        )return false;
        return true;
    }

    public function news(){
        return view('contents.news');
    
    }
}
