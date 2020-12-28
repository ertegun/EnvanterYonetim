<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\User;

class UserDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   User::find($request->id);
        if($control==NULL){
            return redirect()->route('user')->withCookie(cookie('error', 'Silme İşlemi Başarısız!',0.02));
        }
        if($control->getHardwareCount() > 0 || $control->getSoftwareCount() > 0 || $control->getCommonCount() > 0 || $control->getMaterialCount() > 0){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Başarısız!',0.02));
        }
        return $next($request);
    }
}
