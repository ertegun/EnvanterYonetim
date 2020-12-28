<?php

namespace App\Http\Middleware\CommonItem;

use Closure;
use Illuminate\Http\Request;
use App\Models\CommonItem\CommonItemType;

class CommonItemTypeDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control = CommonItemType::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
