<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\MainBladeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ImageController;

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

Route::get('users/{name}', [UsrController::class, 'name'])->name('usr');

Route::get('/test',function(){
    return view('test-content');
});



Route::get('/home',[MainBladeController::class,'usr_data'])->name('home');

Route::get('/prof',function(){
    return view('profiles');
});
//ログイン必須のコンテンツ
Route::middleware(['auth'])->group(function () {
    //マイページの表示
    Route::get('/mypage', [MypageController::class,'viewer'])->name('mypage');
    //コンテンツの管理系のページへのルート
    Route::prefix('admin')->name('admin.')->group(function(){
        //プロジェクト関連
        Route::prefix('/project')->controller(ProjectController::class)->name('project.')->group(function () {
            Route::get('/create','create')->name('create');//プロジェクト作成
            Route::get('/update/{id}', 'update')->name('update');//プロジェクト更新
            Route::get('/preview/{id}', 'preview')->name('preview');//プロジェクトプレビュー
            Route::get('/manage','manage')->name('manage');//プロジェクト管理
        });
        Route::prefix('/diary')->controller(DiaryController::class)->name('diary.')->group(function(){
            Route::get('/{id}/manage')->name('manage');//開発日誌の管理
        });
    });
    //データの保存など、表示しないページのルート
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::post('/save-project',[ProjectController::class,'upload'])->name('project.upload');//プロジェクト保存
        Route::post('/upload-img', [ImageController::class, 'upload'])->name('image.upload');//画像保存
        Route::post('/preview-in-creating',[ProjectController::class,'previewInCreating']);//プロジェクト編集中のプレビュー画面表示
        Route::fallback(function(){
            abort(405,'該当のメソッドではアクセスできません');
        });
    });
});
Route::get('/user-menu', [UserController::class,'menu'])->middleware(['auth'])->name('user');

Route::post('/insert',[ProfileController::class,'insertRecord']);
