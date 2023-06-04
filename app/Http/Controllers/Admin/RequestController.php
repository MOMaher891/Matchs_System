<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    //
    public function index()
    {      
        return view('admin.request.index');
    }

    public function data()
    {
        $data = Booking::bending()->with(['stadium'=>function($q){
            $q->where('admin_id',auth('admin')->user()->id);
        }])->with('user')->groupBy('stadium_id','times','client_id');
        
        return DataTables::of($data)->addColumn('actions',function($data){
            return view('admin.request.action',['type'=>'actions','data'=>$data]);
        })

        ->editColumn('stadium_id',function($data)
        {
            return $data->stadium->name;
        })

        ->editColumn('times',function($data){
            $times = Time::whereIn('id',$this->encodeTimes($data->times))->get();
            $timeFrom =  Carbon::parse($times[0]->from)->format('H:i');
            $timeTo  = Carbon::parse($times[count($times)-1]->to)->format('H:i');     
            return $timeFrom . ' - ' . $timeTo;

        })
        ->editColumn('client_id',function($data)
        {
            return $data->user->name;

        })
        ->addColumn('price',function($data)
        {
            return $data->stadium->price;
        })
        ->addColumn('image',function($data){
            return view('admin.request.action',['type'=>'image','data'=>$data]);
        })->make(true);
    }

    public function toggleStatus(Request $request)
    {
        // return $request->all();
        $booking = Booking::where([
            ['client_id','=',$request->client_id],
            ['stadium_id','=',$request->stadium_id],
            ['times','=',$request->times]
        ])->get();
        // return $booking;
        if($request->status == 'accept')
        {
            foreach($booking as $book)
            {
                // Make New Appointment //
                $book->status = 'accept';
                // return $this->encodeTimes($booking->times);
                $book->code = $this->generateCode($book->id);

                // Add Times
                $book->book_time()->sync($this->encodeTimes($book->times));
                // Add Notification Here
                // end Notification
                $book->save();
            }
            return response()->json(['status'=>true,'message'=>'Booking Accepted Successfully']);

        }else if($request->status == 'decline')
        {
            foreach($booking as $book)
            {
                $book->status = 'decline';
                $book->save();
            }
            return response()->json(['status'=>true]);

        }
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
