<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class UserCreate
{
    public function handle(Request $request, Closure $next)
    {
        $email      =   $request->email;
        $email     .=   "@gruparge.com";
        $control    =   User::select()->where("email",$email)->count();
        if($control>0){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'E-Mail Kullanılıyor!',0.02));
        }
        return $next($request);
    }
}
