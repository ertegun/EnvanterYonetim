<?php

namespace App\Http\Middleware\Vehicle;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleModel;

class VehicleUpdate
{
    public function handle(Request $request, Closure $next)
    {
        if($request->new_model){
            $model = VehicleModel::where('name',$request->new_model)->first();
            if($model){
                return redirect()->back()->withCookie(cookie('error','Bu Marka Zaten Mevcut!',0.02));
            }
        }
        else{
            $model = VehicleModel::find($request->model_id);
            if($model==NULL){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
        }
        $control    =   Vehicle::where('id',$request->id)->where('name',$request->old_name);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
