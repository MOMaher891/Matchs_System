<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Time;
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
        $data = Booking::bending()->distinct()->with(['stadium'=>function($q){
            $q->where('admin_id',auth('admin')->user()->id);
        }])->with('user')->latest();
      
        return DataTables::of($data)->addColumn('actions',function($data){
            return view('admin.request.action',['type'=>'actions','data'=>$data]);
        })

        ->editColumn('stadium_id',function($data)
        {
            return $data->stadium->name;
        })

        ->editColumn('times',function($data){
            $times = Time::whereIn('id',$this->encodeTimes($data->times))->get();
            return view('admin.request.action',['type'=>'times','times'=>$times]);

        })
        ->editColumn('client_id',function($data)
        {
            return $data->user->name;

        })->addColumn('image',function($data){
            return view('admin.request.action',['type'=>'image','data'=>$data]);
        })->make(true);
    }

    public function toggleStatus(Request $request)
    {
        $booking = Booking::findorFail($request->id);
        if($request->status == 'accept')
        {
            // Make New Appointment //
            $booking->status = 'accept';
            // return $this->encodeTimes($booking->times);
            $booking->code = $this->generateCode($booking->id);
            
            // Add Times
            $booking->book_time()->sync($this->encodeTimes($booking->times));
            // Add Notification Here
            // end Notification
            $booking->save();

            return response()->json(['status'=>true,'message'=>'Booking Accepted Successfully']);
        }else if($request->status == 'decline')
        {
            $booking->status = 'decline';
            $booking->save();
            return response()->json(['status'=>true,'message'=>'Booking Decline Successfully']);
        }
        return response()->json(['status'=>true]);
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
