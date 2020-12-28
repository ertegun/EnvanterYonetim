<?php

namespace App\Http\Middleware\CommonItem;

use App\Models\CommonItem\CommonItem;
use Closure;
use Illuminate\Http\Request;

class CommonItemDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   CommonItem::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
