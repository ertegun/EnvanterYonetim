<?php

namespace App\Http\Middleware\Owner;

use App\Models\Vehicle\VehicleOwner;
use Closure;
use Illuminate\Http\Request;

class VehicleDrop
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   VehicleOwner::where('vehicle_id',$request->vehicle_id)->where('owner_id',$request->user_id)->first();
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Araç Teslim İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
