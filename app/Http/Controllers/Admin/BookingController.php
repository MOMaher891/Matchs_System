<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Stadium;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    //
    public function index()
    {
        $total = Booking::sum('total');
        $stadiums = Stadium::where('admin_id',auth('admin')->user()->id)->get();
        return view('admin.booking.index',['stadiums'=>$stadiums,'total'=>$total]);
    }

    public function data(Request $request)
    {
        $data = Booking::filter($request->except('_token'))->notBending()->with('stadium')->latest();
        return DataTables::of($data)
        ->editColumn('client_id',function($data){
            return $data->user->name;
        })->editColumn('stadium_id',function($data){
            return $data->stadium->name;
        })->editColumn('times',function($data){
            $times = Time::whereIn('id',$this->encodeTimes($data->times))->get();
            $timeFrom =  Carbon::parse($times[0]->from)->format('H:i');
            $timeTo  = Carbon::parse($times[count($times)-1]->to)->format('H:i');     
            return $timeFrom . ' - ' . $timeTo;
        })->make(true);

    }
}
