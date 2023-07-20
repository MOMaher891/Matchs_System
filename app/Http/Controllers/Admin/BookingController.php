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
        $totalD = Booking::notBending()->sum('total_in_dolar');

        $stadiums = Stadium::where('admin_id',auth('admin')->user()->id)->get();
        return view('admin.booking.index',['stadiums'=>$stadiums,'total'=>$total,'dolar'=>$totalD]);
    }

    public function data(Request $request)
    {
        $data = Booking::filter($request->all())->notBending()->with('stadium')->latest();
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
        })
        ->addColumn('action',function($data){
            return view('admin.booking.action',['type'=>'action','data'=>$data]);
        })
        ->editColumn('type',function($data)
        {
            return view('admin.booking.action',['type'=>'type','data'=>$data]);
        })
        ->make(true);

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
        $client = Client::all();
        $dataTime = $this->encodeTimes($data->times);
        $dataTime = array_map('intval', $dataTime);
        $bookedTime = BookTime::where('date',Carbon::parse($data->date))
        ->whereNotIn('time_id',$data->book_time->pluck('time_id'))
        ->pluck('time_id');


        $Times = Time::whereNotIn('id',$bookedTime)
        ->whereNotIn('id',$this->encodeTimes($data->stadium->period))
        ->get();


        return view('admin.booking.edit',[
            'clients'=>$client,
            'data'=>$data,
            'stadiums'=>$stadiums,
            'times'=>$Times,
            'dataTime'=>$dataTime
        ]);
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
        // return $request->all();

        $request->validate([
            'stadium_id'=>'required',
            'type'=>'required',
            'times'=>'required|array',
            'date'=>'required|date',
            'total'=>'required'
        ]);
        $stadium = Stadium::findOrFail($request->stadium_id);
        try{
            if($request->type == 'once')
            {
                $booking = Booking::create(array_merge($request->all(),[
                    'times'=>$this->implodeArr($request->times),
                    'code'=>$this->generateCode($request->stadium_id,$request->date),
                    'status'=>'accept'
                ]));

                $time = $this->encodeTimes($booking->times);
                // Add In Book time
                $booking->book_time()->syncWithPivotValues($time,['date'=>$request->date]);
                return redirect()->back()->with('success','Success');

            }
            elseif($request->type == 'const')
            {
                $current_date =  Carbon::parse($request->date);
                $end_date = Carbon::parse($request->date)->addMonths($request->month);
                //Get Number Of Weeks
                $weeks = $end_date->diffInWeeks($current_date);
                //Loop To Add 7days limit number of months
                for($i=0;$i<$weeks;$i++)
                {
                    $book = Booking::create(array_merge($request->all(),
                        [
                            'times'=>$this->implodeArr($request->times),
                            'code'=>$this->generateCode($request->stadium_id,$current_date),
                            'status'=>'accept',
                            'total'=>$stadium->price * (count($request->times)/2),
                            'total_in_dolar'=>$stadium->price_in_dolar * (count($request->times)/2),
                            'date'=>$current_date
                        ]
                    ));
                    $book->book_time()->syncWithPivotValues($request->times,['date'=>$current_date]);
                    $current_date = $current_date->addWeek();

                }
                return redirect()->back()->with('success','Success');

            }
        }catch(Exception $e)
        {
            return $e;
            // return redirect()->back()->with('error','Error');
        }
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'stadium_id'=>'required',
            'total'=>'required',
            'times'=>'required|array',
            'client_id'=>'required',
            'date'=>'required|date'
        ]);
        try{

            $booking = Booking::findOrFail($id);
            $booking->update(array_merge($request->all(),[
                'times'=>$this->implodeArr($request->times),
            ]));

            $time = $this->encodeTimes($booking->times);
            // Delete and Add In Book time
            $booking->book_time()->detach();
            $booking->book_time()->syncWithPivotValues($request->times,['date'=>$request->date]);

            return redirect()->back()->with('success','Success');
        }catch(Exception $e)
        {
            return $e;
            // return redirect()->back()->with('error','Error');
        }
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->book_time()->detach();
        $booking->delete();
        return redirect()->back()->with('success','Success');
    }

    public function total(Request $request)
    {
        $data = [];
        $times = count($request->times);

        $price = Stadium::findOrFail($request->stadium_id);
        $total = 0;
        $total_in_dolar = 0;
        if($request->type == 'const')
        {
            $current_date =  Carbon::parse($request->date);

            $end_date = Carbon::parse($request->date)->addMonths($request->month);
            $weeks = $end_date->diffInWeeks($current_date);
            for($i=0;$i<$weeks;$i++){
                $total += $price->price + ($times/2);
                $total_in_dolar += $price->price_in_dolar +($times/2);
            }

            $data[0] = $total;
            $data[1] = $total_in_dolar;
            return $data;
        }else if($request->type == 'once')
        {
            $total = $price->price * ($times/2);
            $total_in_dolar = $price->price_in_dolar * ($times/2);

            $data[0] = $total;
            $data[1] = $total_in_dolar;
            return $data;

        }
    }
    public function generateCode($id,$date)
    {
        return $id.'-'.$date.'-'.time();
    }
}
