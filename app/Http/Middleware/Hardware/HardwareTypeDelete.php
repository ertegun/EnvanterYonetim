<?php

namespace App\Http\Middleware\Hardware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Hardware\HardwareType;

class HardwareTypeDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control = HardwareType::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
