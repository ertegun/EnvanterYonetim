<?php

namespace App\Http\Middleware\Competent;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class CompetentUpdatePassword
{
    public function handle(Request $request, Closure $next)
    {
        $admin =  Admin::find($request->user()->id);
        if($admin == NULL){
            return redirect()->back()->withCookie(cookie('error', 'İşlem Sırasında Hata!',0.02));
        }
        $password = Hash::check($request->current_password, $admin->password);
        if(!$password){
            return redirect()->back()->withCookie(cookie('error', 'Şifre Hatalı!',0.02));
        }
        if($request->password != $request->password_repeat){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'Şifreler Uyuşmuyor!',0.02));
        }
        return $next($request);
    }
}
