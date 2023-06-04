<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedUser;
use App\Models\Booking;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.users.index');
    }

    public function data()
    {
        $data = DB::table('bookings')->distinct()->pluck('client_id')->toArray();

        $users = Client::with(['block_user'=>function($d){
            $d->where('admin_id',auth('admin')->user()->id);
        }])->whereIn('id',$data)->get();

        return DataTables::of($users)
        ->addColumn('actions',function($users){
            return view('admin.users.action',['type'=>'actions','data'=>$users]);
        })
        ->editColumn('image',function($users){
            return view('admin.users.action',['type'=>'image','data'=>$users]);
        })
        ->make(true);
    }

    public function ActiveUser(Request $request)
    {
        $data = BlockedUser::where('client_id',$request->id)->where('admin_id',auth('admin')->user()->id)->first();

        if($data){
            $data->delete();
        }
        return response()->json(['status'=>true]);

    }



    public function BlockUser(Request $request)
    {
        $data = BlockedUser::create([
            'client_id'=>$request->id,
            'admin_id'=>auth('admin')->user()->id,
        ]);
        return response()->json(['status'=>true]);

    }
}
