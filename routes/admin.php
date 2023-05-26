<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\StadiumController;
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
    });
});


