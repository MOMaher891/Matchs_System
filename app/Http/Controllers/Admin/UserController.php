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
        $data = DB::table('bookings')->distinct()->pluck('client_id')->toArray();
        $users = Client::with(['block_user'=>function($d){
            $d->where('admin_id',auth('admin')->user()->id);
        }])->whereIn('id',$data)->get();
        // return $users;
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
        })->addColumn('trusted',function($users){
            return view('admin.users.action',['type'=>'trusted','data'=>$users]);
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
        $data = BlockedUser::where('client_id',$request->id)->first();
        if(!$data){
            $data = BlockedUser::create([
                'client_id'=>$request->id,
                'admin_id'=>auth('admin')->user()->id,
                'status'=>"blocked"
            ]);
        }
        else{
            $data->update(["status"=>'blocked']);
        }

        return response()->json(['status'=>true]);
    }

    public function trustedUser(Request $request)
    {
        $data = BlockedUser::where('client_id',$request->id)->first();
        if(!$data){
            $data = BlockedUser::create([
                'client_id'=>$request->id,
                'admin_id'=>auth('admin')->user()->id,
                'status'=>"trusted"

            ]);
        }
        else{
            $data->update(["status"=>'trusted']);
        }
        return response()->json(['status'=>true]);
    }
}
