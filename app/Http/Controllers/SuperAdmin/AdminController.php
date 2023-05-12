<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    protected $view = 'super_admin.admins.';

    /**
    * view functions 
    */
    public function index()
    {
        return view($this->view.'index');
    }

}
