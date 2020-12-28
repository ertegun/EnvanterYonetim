<?php

namespace App\Http\Middleware\Owner;

use App\Models\Software;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class OwnerSoftCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Software::find($request->soft_id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error', 'Yazılım Atama Başarısız!',0.02));
        }
        $control    =   User::find($request->user_id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error', 'Yazılım Atama Başarısız!',0.02));
        }
        return $next($request);
    }
}
