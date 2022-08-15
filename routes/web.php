<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UsrController;
use App\Http\Controllers\MainBladeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MypageController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('users/{name}', [UsrController::class, 'name'])->name('usr');

Route::get('/test',function(){
    return view('test-content');
});



Route::get('/main',[MainBladeController::class,'usr_data'])->name('home');

Route::get('/prof',function(){
    return view('profiles');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/diary', [DiaryController::class,'read'])->name('diary');   
    Route::post('/save-project',[ProjectController::class,'upload'])->name('save-project'); 
    Route::get('/save-project', function () {
        abort(405,'Access by GET method is not allowed');
    });
    Route::get('/create-project',[ProjectController::class,'create'])->name('create_project');
    Route::get('/preview_project/{id}', [ProjectController::class,'preview'])->name('preview.project');
    Route::get('/mypage', [MypageController::class,'viewer'])->name('mypage');
});
Route::get('/user-menu', [UsrController::class,'menu'])->middleware(['auth'])->name('user');

Route::post('/insert',[ProfileController::class,'insertRecord']);
