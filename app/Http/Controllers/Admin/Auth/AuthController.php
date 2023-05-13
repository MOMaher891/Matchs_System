<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView(){
        if(!Auth::guard('admin')->check()){
            return view('admin.login');
        }
        else{
            return redirect()->back();
        }
    }

    public function login(Request $request){
        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            // Authentication successful
            return redirect()->route('admin.home')->with('admin_login','Welcome Mr.'.Auth::guard('admin')->user()->name);
        }
        return redirect()->back()->with('auth_failed','Email or password invalid');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
