<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{
    //
   

    public function index()
    {
        $user = auth('client')->user();
        return view('website.profile.index',['user'=>$user]);
    }

    public function data()
    {
        $data = Booking::owner()->with('book_time')->with('stadium')->latest();
         return DataTables::of($data)
         ->editColumn('stadium_id',function($data){
            return $data->stadium->name;
        })->editColumn('times',function($data){
            $times = Time::whereIn('id',$this->encodeTimes($data->times))->get();
            $timeFrom =  Carbon::parse($times[0]->from)->format('H:i');
            $timeTo  = Carbon::parse($times[count($times)-1]->to)->format('H:i');
            return $timeFrom . ' - ' . $timeTo;
        })
        ->make(true);
    }

    public function updateProfile(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required|unique:clients,phone,'.auth('client')->user()->id,
            'address'=>'nullable',
            'date_of_birth'=>'date',
            'image'=>'image'
        ]);
        $image = '';
        $user = Client::findOrFail($id);
        if($request->file('image'))
        {
            $image = $this->updateImage($user->image,$request->file('image'),$this->clientPath);
            $user->update(array_merge($request->all(),['image'=>$image]));
            return redirect()->back()->with('success','Success');
        
        }

        $user->update($request->all());

        return redirect()->back()->with('success','Success');
    }

    public function changeview()
    {
        return view('website.profile.change-password');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'password'=>'required',
            'password_confirmation'=>'required',
            'old_password'=>'required'
        ]);
        if($request->password != $request->password_confirmation)
        {
            return redirect()->back()->with('Error','Password Not Same');
     
        }
        if(Hash::check($request->old_password,auth()->user()->password))
        {
            $admin = Client::find(auth('client')->user()->id);
            $admin->update([
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->back()->with('success','Password Change');
       
        }else
        {
            return redirect()->back()->with('Error','Invaild Password');
     
        }
    }




}
