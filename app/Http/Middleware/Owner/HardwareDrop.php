<?php

namespace App\Http\Middleware\Owner;

use App\Models\Hardware\HardwareOwner;
use Closure;
use Illuminate\Http\Request;

class HardwareDrop
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   HardwareOwner::where('hardware_id',$request->hardware_id)->where('owner_id',$request->user_id)->first();
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
