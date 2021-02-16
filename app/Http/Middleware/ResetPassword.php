<?php

namespace App\Http\Middleware;

use App\Models\Reset;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ResetPassword
{
    public function handle(Request $request, Closure $next)
    {
        $control = Reset::where('token',$request->token)->first();
        if($control == NULL){
            return redirect()->route('login')->withCookie('error','Geçersiz İstek!',0.02);
        }
        $hour      =   Carbon::createFromFormat('Y-m-d H:i:s',$control->created_at)
        ->diffInHours();
        if($hour >= 1){
            Reset::where('token',$request->token)->delete();
            return redirect()->back()->withCookie(cookie('error', 'Talep Zaman Aşımına Uğradı! Lütfen Tekrar Talep Gönderiniz',0.02));
        }
        return $next($request);
    }
}
