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
    Route::get('/','index')->name('client.home');
    Route::group(['middleware'=>'is_blocked'],function(){
        Route::get('show_stadium/{stadium_id}','showStadium')->name('web.stadium')->middleware('checkStadiumBlock');
        Route::post('book','booking')->name('booking');
        Route::get('getDate','getTime')->name('getDates');
        Route::get('getLocation','getlocation');
    
    });
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


Route::group(['controller'=>AuthController::class],function(){
    Route::get('register','registerView')->name('register.view');
    Route::get('verifiy','verifiyView')->name('register.verifiy-view');
    Route::get('resend','resend')->name('resend');
    Route::get('client/logout','logout')->name('client.logout')->middleware('auth:client');
    Route::post('register','register')->name('register');
    Route::post('verifiy','verifiy')->name('verifiy');
    Route::post('login','login')->name('client.login');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
