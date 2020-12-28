<?php

namespace App\Http\Middleware\Material;

use Closure;
use Illuminate\Http\Request;
use App\Models\Material\MaterialType;

class MaterialTypeDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control = MaterialType::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
