<?php

use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\HomeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>'auth'],function(){
    $PREFIX = 'super_admin.';    
    Route::get('/',[HomeController::class,'index'])->name($PREFIX.'index');

    Route::group(['prefix'=>'admins','middleware'=>'auth.superadmin','controller'=>AdminController::class],function(){
        $PREFIX = 'super_admin.admins.';    
        Route::get('index','index')->name($PREFIX.'index');
        Route::get('data','data')->name($PREFIX.'data');
        Route::get('create','create')->name($PREFIX.'create');
        Route::get('edit/{id}','edit')->name($PREFIX.'edit');
        Route::get('delete/{id}','delete')->name($PREFIX.'delete');
        Route::post('store','store')->name($PREFIX.'store');
        Route::post('update/{id}','update')->name($PREFIX.'update');
       
    });
});
