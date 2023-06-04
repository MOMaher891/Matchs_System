<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookTime;
use App\Models\Stadium;
use App\Models\StadiumImage;
use App\Models\Time;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $bookTimes = BookTime::where('date',Carbon::today()->toDateString())->pluck('time_id');

        $bookTimes = $bookTimes->toArray();
        $times = Time::whereNotIn('id', $period)->whereNotIn('id',$bookTimes)->get();

        $images = StadiumImage::where('stadium_id', $stadium_id)->get('image');
        // return $data;
        return view('website.showStadium', compact('data', 'images', 'times'));
    }

    public function booking(Request $request){
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


        return redirect()->back()->with('success','Booking Success');

    }

    public function getTime(Request $request){
        $book_times = BookTime::whereDate('date',$request->date)->get('time_id');
        $period = Stadium::findOrFail($request->std_id);

        $period = explode(',', $period->period);

        $ids =[];
        foreach ($book_times as $time){
            array_push($ids, $time['time_id'] -1);
        }

        $times = Time::whereNotIn('id',$book_times)->whereNotIn('id',$period)->get();

        $text = "";

        foreach($times as $time){
            $time_to = Carbon::parse($time->to)->format('H:i');
            $time_from = Carbon::parse($time->from)->format('H:i');
            $text.="<button class='col-md-3' id='$time->id' onclick='getTime( $time->id )'> $time_from - $time_to  </button>";
        }
        return $text;
    }

    public function getTwoHour(Request $request){
        $book_times = BookTime::whereDate('date',$request->date)->get('time_id');
        $period = Stadium::findOrFail($request->std_id);

        $period = explode(',', $period->period);

        $ids =[];
        foreach ($book_times as $time){
            array_push($ids, $time['time_id'] -1);
        }

        $times = Time::whereNotIn('id',$book_times)->whereNotIn('id',$period)->get();

        $text = "";

        foreach($times as $time){
            $time_from = Carbon::parse($time->from)->format('H:i');
            $time_to = Carbon::parse($time->to)->format('H:i');
            $text.="<button class='col-md-3' onclick='getTime( $time->id )'> $time_from - $time_to  </button>";
        }
        return $text;


    }

}
