<?php

namespace App\Http\Middleware\Software;

use Closure;
use Illuminate\Http\Request;
use App\Models\Software\SoftwareType;

class SoftwareTypeCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control =   SoftwareType::where('name',$request->name)->first();
            if($control!=NULL){
                return redirect()->back()->withCookie(cookie('error','Bu Tür Zaten Kullanılıyor!',0.02));
            }
        return $next($request);
    }
}

