<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        return view('admin.profile.index');   
    }

    public function changePasswordView()
    {
        return view('admin.profile.change-password');   
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:admins,email,'.auth('admin')->user()->id,
            'phone'=>'required|unique:admins,phone,'.auth('admin')->user()->id,
            'image'=>'image'
        ]);
        if($request->file('image'))
        {
            $image = $this->updateImage(auth()->user()->image,$request->file('image'),$this->userPath);
        }

        if(Admin::findOrFail(auth('admin')->user()->id)->update(array_merge($request->all(),['image'=>$image])))
        {
            return redirect()->back()->with('success','Profile Updated');
        }else{
            return redirect()->back()->with('Error','Error Accure');
        }
        
        
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
            $admin = Admin::find(auth('admin')->user()->id);
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
