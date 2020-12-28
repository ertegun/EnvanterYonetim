<?php

namespace App\Http\Middleware\Material;

use App\Models\Material\Material;
use Closure;
use Illuminate\Http\Request;

class MaterialDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Material::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
