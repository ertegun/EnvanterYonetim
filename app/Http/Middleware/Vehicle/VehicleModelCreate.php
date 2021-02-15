<?php

namespace App\Http\Middleware\Vehicle;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vehicle\VehicleModel;

class VehicleModelCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control = VehicleModel::where('name',$request->name)->first();
        if($control != NULL){
            return redirect()->back()->withCookie(cookie('error','Bu Marka Zaten Mevcut!',0.02));
        }
        return $next($request);
    }
}
