<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Stadium;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $stadiumCount = Stadium::owner()->count();
        $requestCount = Booking::bending()->count();
        $bookingCount = Booking::notBending()->count();
        return view('admin.index',[
            'stdCount'=>$stadiumCount,
            'requestCount'=>$requestCount,
            'bookingCount'=>$bookingCount
        ]);
    }
}
