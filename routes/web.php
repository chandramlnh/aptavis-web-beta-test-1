<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    return redirect('/clubs');
});
 
Route::get('/clubs',function(){
    return view('club');
})->name("club");

Route::get('/input-score',function(){
    return view('input-score');
})->name("input-score");

Route::get('/standings',function(){
    return view('standings');
})->name("standings");

Route::get('/dashboard', function () {
    return view('welcome');
});
 
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);