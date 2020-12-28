<?php

namespace App\Http\Middleware\Software;

use App\Models\Software\Software;
use Closure;
use Illuminate\Http\Request;

class SoftwareDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control =   Software::find($request->id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
