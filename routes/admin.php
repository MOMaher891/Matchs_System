<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

/**
 * Authentication
 */

Route::group(['controller'=>AuthController::class],function(){
    $prefix = 'admin';
    Route::get('/login','loginView')->name($prefix.'.login');
    Route::post('/login','login')->name($prefix.'.login.check');
    Route::get('/logout','logout')->name($prefix.'.logout');
});

/**
 * Routes
 */

Route::group(['controller'=>HomeController::class],function(){
    Route::get('/','index')->name('admin.home');
});
