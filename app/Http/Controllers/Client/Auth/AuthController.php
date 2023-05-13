<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use App\Http\Requests\Client\Auth\RegisterRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if(Auth::guard('client')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('home');
        }else{
            return redirect()->route('client.login')->with('error','Invaild Email or Password');
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
        $client = Client::findOrFail($request->id);
        $client->update(['verified'=>true]);
        return redirect('/')->with('success','Account Verified');
    }
}
