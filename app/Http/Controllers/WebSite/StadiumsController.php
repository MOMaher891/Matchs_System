<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Stadium;
use Illuminate\Http\Request;

class StadiumsController extends Controller
{
    //
    public function index()
    {
        $data = Stadium::paginate(9);
        return view('website.stadiums', ['data'=>$data]);
    }
}
