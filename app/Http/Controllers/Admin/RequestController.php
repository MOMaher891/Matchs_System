<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    //
    public function index()
    {
        $data = Booking::bending()->with('client')->latest();
        return $data->get();
        return view('admin.request.index');
    }

    public function data()
    {
        $data = Booking::active()->getAdminStadiums()->with('client')->latest();

        return DataTables::of($data)->addColumn('actions',function($data){
            return view('admin.request.action',['type'=>'actions','data'=>$data]);
        })
        ->editColumn('stadium_id',function($data)
        {
            return $data->stadium->name;
        })
        ->addColumn('image',function($data){
            return view('admin.request.action',['type'=>'image','data'=>$data]);
        })->make(true);
    }
}
