<?php

namespace App\Http\Middleware\Owner;

use App\Models\Material\MaterialOwner;
use Closure;
use Illuminate\Http\Request;

class MaterialDrop
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   MaterialOwner::where('material_id',$request->material_id)
        ->where('owner_id',$request->user_id)
        ->where('id',$request->id)
        ->first();
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
