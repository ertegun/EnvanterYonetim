<?php

namespace App\Http\Middleware\Hardware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Hardware\HardwareType;

class HardwareTypeCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control = HardwareType::where('name',$request->name)->first();
        if($control != NULL){
            return redirect()->back()->withCookie(cookie('error','Tip Adı Kullanılıyor!'));
        }
        $control = HardwareType::where('prefix',$request->prefix)->first();
        if($control != NULL){
            return redirect()->back()->withCookie(cookie('error','Tip Ön Eki Kullanılıyor!'));
        }
        return $next($request);
    }
}
