<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookTime;
use App\Models\Client;
use App\Models\Stadium;
use App\Models\StadiumImage;
use App\Models\Time;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function index()
    {
        $images = StadiumImage::get('image');
        $stadiums = Stadium::active()->with(['stadium_image', 'region'])->paginate(5);
        return view('website.index', compact('images', 'stadiums'));
        // return $images;
    }

    public function showStadium($stadium_id)
    {
        $data = Stadium::with([
            'admin',
            'region' => function ($q) {
                $q->with('city')->get();
            }
        ])->findOrFail($stadium_id);
        $period = explode(',', $data->period);


        $bookTimes = DB::table('book_times')->select()
        ->join('bookings','book_times.book_id','=','bookings.id')
        ->where('book_times.date',Carbon::today()->toDateString())
        ->where('bookings.stadium_id',$data->id)->pluck('book_time.time_id');


        $bookTimes = $bookTimes->toArray();
        $times = Time::whereNotIn('id', $period)->whereNotIn('id',$bookTimes)->get();

        $images = StadiumImage::where('stadium_id', $stadium_id)->get('image');
        // return $data;
        return view('website.showStadium', compact('data', 'images', 'times'));
    }

    public function booking(Request $request){
        // return $request;
        $times_ids = explode(',',$request->times);
        $exists = DB::table('book_times')->select()
        ->join('bookings','book_times.book_id','=','bookings.id')
        ->where('book_times.date',Carbon::parse($request->date)->toDateString())
        ->where('bookings.stadium_id',$request->stadium_id)->whereIn('book_times.time_id',$times_ids)->exists();
        // $exists = BookTime::whereDate('date',$request->date)->get('time_id');
        // return $exists;

        $stadium = Stadium::with('admin')->find($request->stadium_id);
        $client = Client::find($request->client_id);
        $first_time = Time::find($times_ids[0]);
        $last_time = Time::find($times_ids[count($times_ids)-1]);
        $admin = $stadium->admin->name;
        // return $client;


        if($exists){
            $first_time = Time::where('id',$times_ids[0])->first();
            if(count($times_ids) == 4){
                return redirect()->back()->with('error',"You Can't Booking Two Hour From ".Carbon::parse($first_time->from)->format("H:i")." , Try Again..");

            }else{
                return redirect()->back()->with('error',"You Can't Booking Hour And Half Hour From ".Carbon::parse($first_time->from)->format("H:i")." , Try Again..");
            }
        }else{
            $request->validate([
                'date'=>'required|date',
                'times'=>'required'
            ]);
            if($request->has('type')){
                $request['type'] = 'const';
                //Get Selected Date
                $current_date =  Carbon::parse($request->date);
                $end_date = Carbon::parse($request->date)->addMonths($request->months);
                //Get Number Of Weeks
                $weeks = $end_date->diffInWeeks($current_date);
                //Loop To Add 7days limit number of months
                for($i=0;$i<$weeks;$i++){

                    $book = Booking::create([
                        'client_id'=>$request->client_id,
                        'stadium_id'=>$request->stadium_id,
                        'times'=>$request->times,
                        'date'=>$current_date,
                        'type'=>$request['type']
                    ]);

                    $current_date = $current_date->addWeek();


                }
            }else{
                $book = Booking::create([
                    'client_id'=>$request->client_id,
                    'stadium_id'=>$request->stadium_id,
                    'times'=>$request->times,
                    'date'=>$request->date,
                ]);
            }
        }

        $first_time = Carbon::parse($first_time->from)->format('H:i');
        $last_time = Carbon::parse($last_time->to)->format('H:i');
        // return redirect()->back()->with('success','Booking Success');
        return redirect("https://wa.me/$stadium->phone?text=Hello, Mr.$admin,%20 I'M $client->name : I want to book your stadium $stadium->name from $first_time to $last_time %20:%20 Visit link : http://www.facebook.com");

    }

    public function getTime(Request $request){

        $book_times = DB::table('book_times')->select()
        ->join('bookings','book_times.book_id','=','bookings.id')
        ->whereDate('book_times.date',Carbon::parse($request->date))
        ->where('bookings.stadium_id',$request->std_id)->pluck('book_time.time_id');
        $period = Stadium::findOrFail($request->std_id);


        $period = explode(',', $period->period);

        $ids =[];
        foreach ($book_times as $time){
            array_push($ids, $time);
        }
        // return $ids;

        $times = Time::whereNotIn('id',$ids)->whereNotIn('id',$period)->get();
        // return $times;
        $text = "";

        foreach($times as $time){
            $time_to = Carbon::parse($time->to)->format('H:i');
            $time_from = Carbon::parse($time->from)->format('H:i');
            $text.="<button class='col-md-3' id='$time->id' onclick='getTime( $time->id )'> $time_from - $time_to  </button>";
        }
        return $text;
    }


}
