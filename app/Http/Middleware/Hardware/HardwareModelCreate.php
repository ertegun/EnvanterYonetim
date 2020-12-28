<?php

namespace App\Http\Middleware\Hardware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Hardware\HardwareModel;

class HardwareModelCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control = HardwareModel::where('name',$request->name)->first();
        if($control != NULL){
            return redirect()->back()->withCookie(cookie('error','Bu Model Zaten Mevcut!',0.02));
        }
        return $next($request);
    }
}
