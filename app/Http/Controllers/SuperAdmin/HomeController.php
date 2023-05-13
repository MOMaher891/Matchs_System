<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('superadmin.index');
    }

    public function admins(){
        return view('superadmin.admins.index');
    }

    public function clients(){
        return view('superadmin.clients.index');
    }

    public function stadiums(){
        return view('superadmin.stadiums.index');
    }
}
