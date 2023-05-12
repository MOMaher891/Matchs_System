<?php

use App\Http\Controllers\SuperAdmin\HomeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>'auth','controller'=>HomeController::class],function(){
    $PREFIX = 'super_admin.';
    Route::get('/','index')->name($PREFIX.'index');
});
