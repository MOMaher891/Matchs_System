<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use App\Http\Requests\Client\Auth\RegisterRequest;
use App\Models\Client;
use App\Utils\WhatsApp;
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
        if(MainAuth::guard('client')->attempt(['phone'=>$data['phone'],'password'=>$data['password'],'is_blocked'=>false])){
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
        $code = $this->genrateRand();

        $data['password'] = Hash::make($data['password']);
        if( Client::create(array_merge($data,['otp'=>$code])))
        {
            // Send Verification Code Through Whatsapp
            $this->send($data['phone'],$data['name'],$code);

            return redirect()->route('register.verifiy-view')->with('success','Check Your WhatsApp For Verification Code');
     
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
        $client = Client::where('otp',$request->code,'verified',false)->first();
        if(!$client)
        {
            return redirect()->back()->with('error','Invaild Code');
        }
        if($client->update(['verified' => true]))
        {
            return redirect('/')->with('success','Account Verified');

        }else{
            return redirect()->back()->with('error','Error Accure Try Again Later');
        }
    }

    public function resend(Request $request)
    {
        // return $request->data;
        $code = $this->genrateRand();
        $this->send($request->phone,$request->name,$code);
        $data = Client::where('phone',$request->phone,'verified',false)->first();
        // if()
        if($data->update(['otp'=>$code]))
        {
            return redirect()->back()->with('success','Code Sent Check your Whatapp');
        }else{
            return redirect()->back()->with('error','Error Accure');
        }
    }


    public function logout()
    {
        MainAuth::guard('client')->logout();
        return redirect('/')->with('success','Logout Successfuly');
    }

    public function genrateRand()
    {
        return rand(10000,99999);
    }

    public function send($phone,$name,$code)
    {
        $message = new WhatsApp($phone,$name,$code);
        $message->startConversation();
        $message->sendingWhatsAppMessage();
    }

}
