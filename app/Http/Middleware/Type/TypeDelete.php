<?php

namespace App\Http\Middleware\Type;

use Closure;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Type::where('id',$request->type_id)->count();
        if($control==0){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
