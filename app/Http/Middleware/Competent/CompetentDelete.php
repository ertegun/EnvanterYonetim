<?php

namespace App\Http\Middleware\Competent;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class CompetentDelete
{
    public function handle(Request $request, Closure $next)
    {
        if($request->current_password != $request->current_password_repeat){
            return redirect()->back()->withCookie(cookie('error', 'Şifreler Uyuşmuyor!',0.02));
        }
        $password = Hash::check($request->current_password, $request->user()->password);
        if(!$password){
            return redirect()->back()->withCookie(cookie('error', 'Şifre Hatalı!',0.02));
        }
        return $next($request);
    }
}
