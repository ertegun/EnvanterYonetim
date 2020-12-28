<?php

namespace App\Http\Middleware\Type;

use Closure;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Type::where('prefix',$request->type_prefix)->orWhere('name',$request->type_name)->count();
        if($control>0){
            return redirect()->back()->withInput()->withCookie(cookie('error','Tip Ön Eki veya Tip Adı Kullanılıyor!',0.02));
        }
        return $next($request);
    }
}
