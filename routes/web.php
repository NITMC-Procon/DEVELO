<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainBladeController;
use App\Http\Controllers\Test1Controller;

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

Route::get('/', [MainBladeController::class,'usr_data']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/annasui', function(){
    return view('ANNASUI');
});

Route::get('/testForm1', function(){
    return view('ANNDB');
});

Route::post('DBtest1', [Test1Controller::class,'yamato']);