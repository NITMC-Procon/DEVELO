<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\MainBladeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiaryController;

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
    Route::get('/test',function(){return view('contents.test');});
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
        });

        
        //開発日誌関連
        Route::prefix('/diary')->controller(DiaryController::class)->name('diary.')->group(function(){
            Route::get('/manage','manage')->name('manage');//開発日誌の管理
            Route::get('/update/{id}', 'update')->name('update');//デイリー更新
        });
    });
    //データの保存など、表示しないページのルート
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::post('/save-project',[ProjectController::class,'upload'])->name('project.upload');//プロジェクト保存
        Route::post('/upload-img', [ImageController::class, 'upload'])->name('image.upload');//画像保存
        Route::post('/preview-in-creating',[ProjectController::class,'previewInCreating']);//プロジェクト編集中のプレビュー画面表示
        Route::post('/view',[ProjectController::class,'view'])->name('project.view');//プロジェクト情報表示画面
        Route::get('/release/{id}',[ProjectController::class,'release'])->name('project.release');//プロジェクト公開
        Route::get('/private/{id}',[ProjectController::class,'private'])->name('project.private');//プロジェクト非公開
        Route::post('/store-course',[CourseController::class,'store'])->name('course.store');
        Route::fallback(function(){
            abort(405,'該当のメソッドではアクセスできません');
        });
    });
});

