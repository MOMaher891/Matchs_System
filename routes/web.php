<?php

use App\Http\Controllers\Client\Auth\AuthController;
use App\Http\Controllers\WebSite\WebsiteController;
use Illuminate\Support\Facades\Route;

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

Route::group(['controller'=>WebsiteController::class],function(){
    Route::get('/','index');
});

Route::get('register',[AuthController::class,'registerView'])->name('register.view');
Route::get('verifiy',[AuthController::class,'verifiyView'])->name('register.verifiy-view');
Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('verifiy',[AuthController::class,''])->name('verifiy');

Route::post('login',[AuthController::class,'login'])->name('client.login');

Route::get('client/logout',[AuthController::class,'logout'])->name('client.logout')->middleware('auth:client');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
