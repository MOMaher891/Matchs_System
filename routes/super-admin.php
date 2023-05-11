<?php

use App\Http\Controllers\SuperAdmin\HomeController;
use Illuminate\Support\Facades\Route;


define('PREFIX','super_admin.');

Route::group(['middleware'=>'auth','controller'=>HomeController::class],function(){
    Route::get('/','index')->name(PREFIX.'index');
});
