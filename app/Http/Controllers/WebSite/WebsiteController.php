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
        $stadiums = Stadium::with(['stadium_image', 'region'])->paginate(5);
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
        $request['type'] = $request->has('type') ? 'const' : 'once';
        $book = Booking::create($request->all());
        BookTime::create([
            'book_id' => $book['id'],
            'time_id' => $book['times'],
            'date'=>$book['date']
        ]);
        return redirect()->back()->with('success','Booking Success');

    }

    public function getTime(Request $request){
        $book_times = BookTime::whereDate('date',$request->date)->get('time_id');
        $period = Stadium::findOrFail($request->std_id);

        $period = explode(',', $period->period);

        $ids = [];
        foreach ($book_times as $time){
            array_push($ids,$time->time_id);
        }

        $times = Time::whereNotIn('id',$ids)->whereNotIn('id',$period)->get();

        $text = "";

        foreach($times as $time){
            $text.="<button class='col-md-3' onclick='getTime( $time->id )'> $time->from </button>";
        }
        return $text;
    }

    public function getlocation(){
        $link = "https://goo.gl/maps/Nx2ziisYs8tkHiwH8";

        // Extract latitude and longitude from the link
        $queryString = parse_url($link, PHP_URL_QUERY);
        parse_str($queryString, $queryParameters);

        if (isset($queryParameters['q'])) {
            $coordinates = explode(',', $queryParameters['q']);

            if (count($coordinates) >= 2) {
                $latitude = $coordinates[0];
                $longitude = $coordinates[1];
                return $latitude;
                // Use latitude and longitude as needed
            } else {
                // Invalid coordinates
                return 'error';
            }
        } else {
            // Coordinates not found
            return 'error 1';
        }
    }
}
