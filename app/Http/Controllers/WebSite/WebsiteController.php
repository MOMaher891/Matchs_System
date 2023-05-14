<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\Stadium;
use App\Models\StadiumImage;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $images = StadiumImage::get('image');
        $stadiums = Stadium::with('stadium_image')->paginate(5);
        return view('website.index',compact('images','stadiums'));
        // return $images;


    }
}
