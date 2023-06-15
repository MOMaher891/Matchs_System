<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookTime;
use App\Models\Stadium;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StadiumsController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Stadium::latest();
        if($request->get('date') && $request->get('time_from') && $request->get('time_to'))
        {
            $bookedTime = BookTime::whereIn('time_id',[$request->get('time_from'),$request->get('time_to')])
            ->where('date',$request->get('date'))->pluck('book_id');
            $bookedTime =  json_decode(json_encode($bookedTime), true);;
         
            $bookings = Booking::whereIn('id',$bookedTime)->pluck('stadium_id');
            $data->whereNotIn('id',$bookings);
        }

        if( $request->get('region'))
        {
            $data->where('region_id',$request->region);
        }
       
        return view('website.stadiums', ['data'=>$data->paginate(9)]);
    }
}
