<?php

namespace App\Http\Middleware\Material;

use App\Models\Material\MaterialType;
use Closure;
use Illuminate\Http\Request;

class MaterialCreate
{
    public function handle(Request $request, Closure $next)
    {
        if($request->new_type){
            $type   =   MaterialType::where('name',$request->new_type)->first();
            if($type){
                return redirect()->back()->withCookie(cookie('error','Tip Zaten Kullanılıyor!',0.02));
            }
        }
        else{
            $type   =   MaterialType::find($request->type_id);
            if($type==NULL){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
        }
        return $next($request);
    }
}
