<?php

namespace App\Http\Middleware\Vehicle;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vehicle\VehicleModel;

class VehicleModelDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control = VehicleModel::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
