<?php

namespace App\Http\Middleware\Vehicle;

use App\Models\Vehicle\Vehicle;
use Closure;
use Illuminate\Http\Request;

class VehicleDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Vehicle::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
