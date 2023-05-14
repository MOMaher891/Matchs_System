<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use App\Http\Requests\Client\Auth\RegisterRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as MainAuth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        // return $data;
        if(MainAuth::guard('client')->attempt(['phone'=>$data['phone'],'password'=>$data['password']]) ){
            return redirect('/')->with('success','Welcome');
        }else{
            return redirect('/')->with('error','Invaild Email or Password');
        }
    }


    public function registerView()
    {
        return view('website.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        if( Client::create($data))
        {
            return redirect()->route('register.verifiy-view');
        }else
        {
            return redirect()->back()->with('error','Error Try Again');
        }
    }

    public function verifiyView()
    {
        return view('website.verifiy');   
    }

    public function verifiy(Request $request)
    {
        $request->validate([
            'code'=>'required'
        ]);
        
        $client = Client::where('phone',$request->phone);

        if($client->update(['verified' => $request->isAuth]))
        {
            return redirect('/')->with('success','Account Verified');

        }else{
            return redirect()->back()->with('error','Error Accure Try Again Later');
        }
    }

    public function logout()
    {
        MainAuth::guard('client')->logout();
        return redirect('/')->with('success','Logout Successfuly');
    }


}
