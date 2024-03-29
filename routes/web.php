<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MainBladeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestBladeController;
use App\Http\Controllers\ReturnContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;

use App\Http\Controllers\ShowprojectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';






Route::get('/',[MainBladeController::class,'usr_data'])->name('home');

//ログイン必須のコンテンツ
Route::middleware(['auth'])->group(function () {
    Route::get('/test',[TestBladeController::class,'view']);
    Route::post('/test',function(Request $request){
        $message = [];
        foreach($request->file() as $file){
            array_push($message,$file->getClientOriginalName());
       }
        return ['message'=>$message];
    });
    Route::get('/profile/store',[ProfileController::class,'viewer'])->name('profile.view');
    //マイページの表示
    Route::get('/mypage', [MypageController::class,'viewer'])->name('mypage');
    //ユーザメニューの表示
    Route::get('/user-menu', [UserController::class,'menu'])->name('user');
    //コンテンツの管理系のページへのルート
    Route::prefix('admin')->name('admin.')->group(function(){
        //プロジェクト関連
        Route::prefix('/project')->controller(ProjectController::class)->name('project.')->group(function () {
            Route::get('/create','create')->name('create');//プロジェクト作成
            Route::get('/update/{id}', 'update')->name('update');//プロジェクト更新
            Route::get('/preview/{id}', 'preview')->name('preview');//プロジェクトプレビュー
            Route::get('/manage','manage')->name('manage');//プロジェクト管理
            Route::get('/release/{id}','setRelease')->name('setrelease');//プロジェクト公開設定
            Route::get('/release/update/{id}','releaseUpdate')->name('release.update');//プロジェクト公開設定
            Route::get('/news','news')->name('news');//お知らせ
            
        });
        //コース関連
        Route::prefix('/course')->controller(CourseController::class)->name('course.')->group(function(){
            Route::get('/create/{id}','create')->name('create');
            Route::get('/manage/{id?}','manage')->name('manage');
            Route::get('/update/{course_id}','update')->name('update');
            Route::get('/release/{id}','setRelease')->name('release.set');
        });

        
        //開発日誌関連
        Route::prefix('/diary')->controller(DiaryController::class)->name('diary.')->group(function(){
            Route::get('/manage/{id?}','manage')->name('manage');//開発日誌の管理
            Route::get('/managedetail','managedetail')->name('managedetail');//開発日誌の管理
            Route::get('/update/{id}', 'update')->name('update');//デイリー更新
            Route::get('/create/{id?}','create')->name('create');//プロジェクト作成

        });
    });
    Route::prefix('/support')->controller(SupportController::class)->name('support.')->group(function(){
        Route::get('/project/{id}','project')->name('project');
        Route::get('/course/{id}','course')->name('course');
        Route::get('/finish/{id}','finish')->name('finish');
    });

    //データの保存など、表示しないページのルート
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::post('/save-project',[ProjectController::class,'upload'])->name('project.upload');//プロジェクト保存
        Route::post('/save-diary',[DiaryController::class,'upload'])->name('diary.upload');//プロジェクト保存
        Route::post('/upload-img', [ImageController::class, 'upload'])->name('image.upload');//画像保存
        Route::post('/preview-in-creating',[ProjectController::class,'previewInCreating']);//プロジェクト編集中のプレビュー画面表示
        Route::post('/view',[ProjectController::class,'view'])->name('project.view');//プロジェクト情報表示画面
        Route::get('/release/{id}',[ProjectController::class,'release'])->name('project.release');//プロジェクト公開
        Route::get('/private/{id}',[ProjectController::class,'private'])->name('project.private');//プロジェクト非公開
        Route::post('/store-course/{id}',[CourseController::class,'store'])->name('course.store');
        Route::post('/store_return_content/{id}',[ReturnContentController::class,'store'])->name('returncontent.store');
        Route::post('/store-profile',[ProfileController::class,'store'])->name('profile.store');
        Route::post('/support-course/{id}',[SupportController::class,'store'])->name('support.store');
        Route::get('/receive-return/{id}',[ReturnContentController::class,'receive'])->name('return.receive');
        Route::get('/release-course/{id}',[CourseController::class,'release'])->name('course.release');//プロジェクト公開
        Route::fallback(function(){
            abort(405,'アクセスできません');
        });
    });
});

Route::get('/search', [SearchController::class,'search'])->name('search');

Route::get('/search/res', function(){
    return view('Search.res');
});

Route::get('/show', [ShowprojectController::class, 'show']);