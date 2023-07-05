<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\StadiumController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Authentication
 */

Route::group(['controller'=>AuthController::class],function(){
    $prefix = 'admin';
    Route::get('/login','loginView')->middleware('guest:admin')->name($prefix.'.login');
    Route::post('/login','login')->name($prefix.'.login.check');
    Route::get('/logout','logout')->name($prefix.'.logout');
});

/**
 * Routes
 */

Route::group(['middleware'=>'auth:admin'],function(){

    Route::group(['controller'=>HomeController::class,'prefix'=>'home'],function(){
        Route::get('/','index')->name('admin.home');
    });


    Route::group(['controller'=>RequestController::class,'prefix'=>'requests'],function(){
        $prefix = 'request.';
        Route::get('/','index')->name($prefix.'index');
        Route::get('/data','data')->name($prefix.'data');
        Route::get('/toggle-status','toggleStatus')->name($prefix.'toggle-status');
    });



    Route::group(['controller'=>StadiumController::class,'prefix'=>'stadiums'],function(){
        $prefix = 'admin.stadiums.';
        Route::get('/','index')->name($prefix.'index');
        Route::get('/data','data')->name($prefix.'data');
        Route::get('/toggle-status','toggleOpen')->name($prefix.'toggle-status');
        Route::get('create','create')->name($prefix.'create');
        Route::post('store','store')->name($prefix.'store');
        Route::get('edit/{id}','edit')->name($prefix.'edit');
        Route::post('update/{id}','update')->name($prefix.'update');
        Route::get('get-region-data','getRegions')->name($prefix.'get-region-data');
        Route::get('delete/{id}','delete')->name($prefix.'delete');
    });

    Route::group(['controller'=>UserController::class,'prefix'=>'users'],function(){
        $prefix = 'admin.users.';
        Route::get('/','index')->name($prefix.'index');
        Route::get('/data','data')->name($prefix.'data');
        Route::get('/active-user','ActiveUser')->name($prefix.'active-user');
        Route::get('/block-user','BlockUser')->name($prefix.'block-user');
        Route::get('/trust-user','trustedUser')->name($prefix.'trust-user');
    });

    Route::group(['controller'=>BookingController::class,'prefix'=>'bookings'],function(){
        $prefix = 'admin.bookings.';
        Route::get('/','index')->name($prefix.'index');
        Route::get('/data','data')->name($prefix.'data');
        Route::get('/create','create')->name($prefix.'create');
        Route::get('/edit/{id}','edit')->name($prefix.'edit');
        Route::get('/delete/{id}','delete')->name($prefix.'delete');

        Route::post('store','store')->name($prefix.'store');
        Route::get('/get-available-time','getAvailableTime')->name($prefix.'get-time');
        Route::get('/get-total','total')->name($prefix.'total');

        Route::post('update/{id}','update')->name($prefix.'update');
    });


    Route::group(['controller'=>ProfileController::class,'prefix'=>'profile'],function(){
        $prefix = 'admin.profiles.';
        Route::get('/','profile')->name($prefix.'index');
        Route::get('/change-password','changePasswordView')->name($prefix.'change-password-view');
        Route::post('/update','update')->name($prefix.'update');
        Route::post('/change-password','changePassword')->name($prefix.'change-password');

    });


});


