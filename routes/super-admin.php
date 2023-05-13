<?php

use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\HomeController;
use App\Http\Controllers\SuperAdmin\StadiumController;
use App\Http\Controllers\SuperAdmin\ClientController;
use App\Http\Controllers\SuperAdmin\UserController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>'auth'],function(){
    $PREFIX = 'super_admin.';
    Route::get('/home',[HomeController::class,'index'])->name($PREFIX.'index');

/**
 * Super Admins
 */

    Route::group(['prefix'=>'admins','controller'=>AdminController::class],function(){
        $PREFIX = 'super_admin.admins.';
        Route::get('/','index')->name($PREFIX.'index');
        Route::get('data','data')->name($PREFIX.'data');
        Route::get('create','create')->name($PREFIX.'create');
        Route::get('edit/{id}','edit')->name($PREFIX.'edit');
        Route::get('delete/{id}','delete')->name($PREFIX.'delete');
        Route::post('store','store')->name($PREFIX.'store');
        Route::post('update/{id}','update')->name($PREFIX.'update');
    });

/**
 * Admins (Users)
 */

    Route::group(['prefix'=>'users','controller'=>UserController::class],function(){
        $PREFIX = 'super_admin.users.';
        Route::get('/','index')->name($PREFIX.'index');
        Route::get('data','data')->name($PREFIX.'data');
        Route::get('create','create')->name($PREFIX.'create');
        Route::get('edit/{id}','edit')->name($PREFIX.'edit');
        Route::get('delete/{id}','delete')->name($PREFIX.'delete');
        Route::post('store','store')->name($PREFIX.'store');
        Route::post('update','update')->name($PREFIX.'update');
    });

/**
 * Stadiums
 */

    Route::group(['prefix'=>'stadiums','controller'=>StadiumController::class],function(){
        $PREFIX = 'super_admin.stadiums.';
        Route::get('/','index')->name($PREFIX.'index');
        Route::get('data','data')->name($PREFIX.'data');
        Route::get('create','create')->name($PREFIX.'create');
        Route::get('edit/{id}','edit')->name($PREFIX.'edit');
        Route::get('show/{id}','show')->name($PREFIX.'show');
        Route::get('delete/{id}','delete')->name($PREFIX.'delete');
        Route::post('store','store')->name($PREFIX.'store');
        Route::post('update/{id}','update')->name($PREFIX.'update');
    });

/**
 * Clients
 */

    Route::group(['prefix'=>'clients','controller'=>ClientController::class],function(){
        $PREFIX = 'super_admin.clients.';
        Route::get('/','index')->name($PREFIX.'index');
        Route::get('data','data')->name($PREFIX.'data');
        Route::get('edit/{id}','edit')->name($PREFIX.'edit');
        Route::get('delete/{id}','delete')->name($PREFIX.'delete');
        Route::post('update/{id}','update')->name($PREFIX.'update');
        Route::get('/toggle','toggle')->name($PREFIX.'toggle');
    });

});
