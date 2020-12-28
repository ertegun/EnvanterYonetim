<?php

namespace App\Http\Middleware\Material;

use Closure;
use Illuminate\Http\Request;
use App\Models\Material\MaterialType;

class MaterialTypeCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control = MaterialType::where('name',$request->name)->first();
        if($control != NULL){
            return redirect()->back()->withCookie(cookie('error','Tip Adı Kullanılıyor!'));
        }
        return $next($request);
    }
}
