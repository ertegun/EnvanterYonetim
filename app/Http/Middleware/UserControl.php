<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;

class UserControl
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Admin::where('user_name',$request->user_name)->where('password',$request->password)->first();
        if($control==NULL){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'Kullanıcı Adı veya Şifre Hatalı!',0.02));
        }
        return $next($request);
    }
}
