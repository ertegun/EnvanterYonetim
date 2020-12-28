<?php

namespace App\Http\Middleware\CommonItem;

use Closure;
use Illuminate\Http\Request;
use App\Models\CommonItem\CommonItemType;

class CommonItemTypeCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control = CommonItemType::where('name',$request->name)->first();
        if($control != NULL){
            return redirect()->back()->withCookie(cookie('error','Tip Adı Kullanılıyor!'));
        }
        return $next($request);
    }
}
