<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Stadium;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $stadiumCount = Stadium::count();
        $booking = Booking::count();
        $clients = Client::count();
        return view('superadmin.index',[
        'stdCount'=>$stadiumCount,
        'booking'=>$booking,
        'clients'=>$clients]);
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
