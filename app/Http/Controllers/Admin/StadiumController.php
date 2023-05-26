<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class StadiumController extends Controller
{
    //
    public function index()
    {
        $data = Stadium::owner()->with('region')->with('stadium_image')->latest();
        // return $data->get();
        return view('admin.stadium.index');
    }
    public function data()
    {
        $data = Stadium::owner()->with('region')->with('stadium_image')->latest();
        return DataTables::of($data)
        ->addColumn('actions',function($data){
            return view('admin.stadium.action',['type'=>'actions','data'=>$data]);
        })
        ->editColumn('region_id',function($data){
            return $data->region->name;
        })
        ->addColumn('image',function($data){
            return view('admin.stadium.action',['type'=>'image','data'=>$data]);

            // return $data->stadium_image[0]->image;
        })
        ->make(true);

    }

    public function toggleOpen(Request $request)
    {
        $data = Stadium::findOrFail($request->id);
        $data->is_open = $request->is_open;
        $data->save();
        return response()->json(['status'=>true]);   
    }
}
