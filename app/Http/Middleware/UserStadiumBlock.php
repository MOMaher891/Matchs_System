<?php

namespace App\Http\Middleware;

use App\Models\BlockedUser;
use App\Models\Stadium;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStadiumBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $stadiumId =  $request->route('stadium_id');
        $owner = Stadium::find($stadiumId)->admin_id; 
        $checkIfBlock = BlockedUser::where('client_id',auth('client')->user()->id)
        ->where('admin_id',$owner)->first();
        if($checkIfBlock)
        {
            return redirect()->back()->with('error','Stadium Owner Has Blocked You . Contact Us');
        }
        return $next($request);
    }
}
