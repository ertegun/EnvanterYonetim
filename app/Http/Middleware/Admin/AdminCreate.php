<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;

class AdminCreate
{
    public function handle(Request $request, Closure $next)
    {
        $email      =   $request->email;
        $email     .=   "@gruparge.com";
        $control    =   Admin::select()->where("email",$email)->count();
        if($control>0){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'E-Mail Kullanılıyor!',0.02));
        }
        if(Admin::where('user_name',$request->user_name)->count()){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'Kullanıcı Adında Yetkili Mevcut!',0.02));
        }
        if($request->password != $request->password_repeat){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'Şifreler Uyuşmuyor!',0.02));
        }
        return $next($request);
    }
}
