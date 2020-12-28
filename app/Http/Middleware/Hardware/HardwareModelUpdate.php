<?php

namespace App\Http\Middleware\Hardware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Hardware\HardwareModel;

class HardwareModelUpdate
{
    public function handle(Request $request, Closure $next)
    {
        if($request->old_name == $request->name){
            return redirect()->back()->withCookie(cookie('error','Bir Değişiklik Yapmadınız!',0.02));
        }
        else{
            $control = HardwareModel::where('name',$request->name)->first();
            if($control != NULL){
                return redirect()->back()->withCookie(cookie('error','Model İsmi Kullanılıyor!',0.02));
            }
        }
        return $next($request);
    }
}
