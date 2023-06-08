<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookTime;
use App\Models\Client;
use App\Models\Stadium;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    //
    public function index()
    {
        $total = Booking::notBending()->sum('total');
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


    public function create()
    {
        $data = Stadium::owner()->get();
        $client = Client::all();
        return view('admin.booking.create',['data'=>$data,'clients'=>$client]);
    }

    public function edit($id)
    {
        $stadiums = Stadium::owner()->get();
        $data = Booking::with('book_time')->with('stadium')->findOrFail($id);
        return view('admin.booking.edit',['data'=>$data,'stadiums'=>$stadiums]);
    }

    public function getAvailableTime(Request $request)
    {
        $closedTime = Stadium::findOrFail($request->stadium_id)->period;
        $bookTimes =  DB::table('book_times')->select()
        ->join('bookings','book_times.book_id','=','bookings.id')
        ->where('book_times.date',Carbon::parse($request->date))
        ->where('bookings.stadium_id',$request->stadium_id)->pluck('time_id'); 

        $avaiableTime = Time::whereNotIn('id',$this->encodeTimes($closedTime))
        ->whereNotIn('id',$bookTimes)->get();

        $text = "";
        foreach($avaiableTime as $time){
            $time_to = Carbon::parse($time->to)->format('H:i');
            $time_from = Carbon::parse($time->from)->format('H:i');
            $text.="<option value='$time->id'>$time_from - $time_to</option>";
        }
        return $text;
    }
    public function store(Request $request)
    {
        $request->validate([
            'stadium_id'=>'required',
            'type'=>'required',
            'times'=>'required|array',
            'date'=>'required|date'
        ]);
        try{
            $booking = Booking::create(array_merge($request->all(),[
                'times'=>$this->implodeArr($request->times),
                'code'=>$this->generateCode($request->stadium_id),
                'status'=>'accept'
            ]));
    
            $time = $this->encodeTimes($booking->times);
            // Add In Book time
            $booking->book_time()->syncWithPivotValues($time,['date'=>$request->date]);

            return redirect()->back()->with('success','Success');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error','Error');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'stadium_id'=>'required',
            'type'=>'required',
            'total'=>'required',
            'times'=>'required|array',
            'client_id'=>'required',
            'date'=>'required|date'
        ]);
        try{
            $booking = Booking::create(array_merge($request->all(),[
                'times'=>$this->implodeArr($request->times),
                'code'=>$this->generateCode($request->stadium_id),
            ]));
    
            $time = $this->encodeTimes($booking->times);
            // Add In Book time
            $booking->book_time()->syncWithPivotValues($time,['date'=>$request->date]);

            return redirect()->back()->with('success','Success');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error','Error');
        }
    }
    
    public function total(Request $request)
    {
        $times = count($request->times);
        
        $price = Stadium::findOrFail($request->stadium_id)->price;
        $total = 0;
        if($request->type == 'const')
        {
            $current_date =  Carbon::parse($request->date);
            $end_date = Carbon::parse($request->date)->addMonths($request->months);
            $weeks = $end_date->diffInWeeks($current_date);
            for($i=0;$i<$weeks;$i++){
                $total += $price + ($times/2);            
            }

            return $total;
        }else if($request->type == 'once')
        {
            $total = $price * ($times/2);
            return $total;
        }
    }
    public function generateCode($id)
    {
        return $id.'-'.time();
    }
}
