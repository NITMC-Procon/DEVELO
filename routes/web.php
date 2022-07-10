<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainBladeController;
use App\Http\Controllers\UsrController;

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

Route::get('users/{name}', [UsrController::class, 'name'])->name('usr');

Route::get('/test',function(){
    return view('test-content');
});