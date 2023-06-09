<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookTime;
use App\Models\Client;
use App\Models\Region;
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
        $regions = Region::all();
        $times = Time::all();
        $images = StadiumImage::limit(5)->get('image');
        $stadiums = Stadium::active()->with(['stadium_image', 'region'])->paginate(5);
        return view('website.index', compact('times','images', 'stadiums','regions'));
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
        $times_ids = explode(',',$request->times);
        $exists = DB::table('book_times')->select()
        ->join('bookings','book_times.book_id','=','bookings.id')
        ->where('book_times.date',Carbon::parse($request->date)->toDateString())
        ->where('bookings.stadium_id',$request->stadium_id)->whereIn('book_times.time_id',$times_ids)->exists();

        $stadium = Stadium::with('admin')->find($request->stadium_id);
        $client = Client::with('block_user')->find($request->client_id);
        $first_time = Time::find($times_ids[0]);
        $last_time = Time::find($times_ids[count($times_ids)-1]);
        $admin = $stadium->admin->name;

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
                'times'=>'required',
            ]);
            if(count($client->block_user)!= 0 && $client->block_user[0]->status == 'trusted'){
                if($request->has('type')){
                    $request->validate([
                        'months' =>'nullable|required'
                    ]);
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
                            'type'=>$request['type'],
                            'status'=>"accept"
                        ]);
                        $current_date = $current_date->addWeek();
                    }
                }else{
                    $book = Booking::create([
                        'client_id'=>$request->client_id,
                        'stadium_id'=>$request->stadium_id,
                        'times'=>$request->times,
                        'date'=>$request->date,
                        'status'=>"accept"
                    ]);
                }

                $booking = Booking::where([
                    ['client_id','=',$request->client_id],
                    ['stadium_id','=',$request->stadium_id],
                    ['times','=',$request->times]

                ])->get();
                $client = Client::findOrFail($request->client_id);
                $stadium = Stadium::findOrFail($request->stadium_id);

                foreach($booking as $book)
                {
                    // Make New Appointment //
                    $book->status = 'accept';
                    // return $this->encodeTimes($booking->times);
                    $book->code = $this->generateCode($book->id);
                    // Convert Time To array
                    $time = $this->encodeTimes($book->times);
                    // Add Times
                    $book->book_time()->syncWithPivotValues($time,['date'=>$book->date]);
                    // Calculate Total
                    $total =  $stadium->price * (count($time)/2);
                    $total_in_dolar = $stadium->price_in_dolar  *  (count($time)/2);
                    // Add Notification Here
                    // end Notification
                    $book->total = $total;
                    $book->total_in_dolar = $total_in_dolar;

                    $book->save();
                }

            }
            else{
                if($request->has('type')){
                    $request->validate([
                        'months' =>'nullable|required'
                    ]);
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
        }

        $first_time = Carbon::parse($first_time->from)->format('H:i');
        $last_time = Carbon::parse($last_time->to)->format('H:i');
        // return redirect()->back()->with('success','Booking Success');
        return redirect()->away("https://wa.me/$stadium->phone?text=Hello, Mr.$admin,%20 I'M $client->name : I want to book your stadium $stadium->name from $first_time to $last_time %20:%20 Visit link : http://www.facebook.com")->header('target', '_blank');

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
            $text.="<button class='col-md-3 col-xl-3 col-sm-3 avaliable_times' id='$time->id' onclick='getTime( $time->id )'> $time_from - $time_to  </button>";
        }
        return $text;
    }

    public function generateCode($id)
    {
        return $id.'-'.time();
    }

    public function encodeTimes($str)
    {
        $data = explode(',',$str);
        return $data;
    }
}
