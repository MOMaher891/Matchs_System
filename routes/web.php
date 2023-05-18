<?php

use App\Http\Controllers\Client\Auth\AuthController;
use App\Http\Controllers\WebSite\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Utils\WhatsApp;
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
Route::get('start-test-message',function(){
    // return 'test message';
    $message  =new WhatsApp("+201113050566",'magdy',rand(10000,99999));
    $message->startConversation();
    return $message->sendingWhatsAppMessage();

    // return $message->sendingWhatsAppMessage();
});
// Route::get('test-message',function(){
//     // return 'test message';
//     $message  =new WhatsApp("+201113050566",'magdy');
// });


Route::get('register',[AuthController::class,'registerView'])->name('register.view');
Route::get('verifiy',[AuthController::class,'verifiyView'])->name('register.verifiy-view');
Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('verifiy',[AuthController::class,'verifiy'])->name('verifiy');
Route::get('resend',[AuthController::class,'resend'])->name('resend');
Route::post('login',[AuthController::class,'login'])->name('client.login');

Route::get('client/logout',[AuthController::class,'logout'])->name('client.logout')->middleware('auth:client');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
