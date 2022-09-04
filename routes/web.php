<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UsrController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/diary', [DiaryController::class,'read'])->name('diary');   
    Route::post('/save-project',[ProjectController::class,'upload'])->name('save-project'); 
    Route::get('/save-project', function () {
        abort(405,'Access by GET method is not allowed');
    });
    Route::get('/content/project/update', [ProjectController::class,'update'])->name('update-project');
    Route::get('/content/project/create',[ProjectController::class,'create'])->name('create_project');
    Route::get('/content/project/preview/{id}', [ProjectController::class,'preview'])->name('preview.project');
    Route::get('/mypage', [MypageController::class,'viewer'])->name('mypage');
    Route::post('/upload-img', [ImageController::class, 'upload'])->name('upload.img');
    Route::post('/preview-in-creating',[ProjectController::class,'previewInCreating']);
});
Route::get('/user-menu', [UsrController::class,'menu'])->middleware(['auth'])->name('user');

Route::post('/insert',[ProfileController::class,'insertRecord']);
