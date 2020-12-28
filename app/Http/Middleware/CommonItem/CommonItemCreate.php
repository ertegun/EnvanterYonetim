<?php

namespace App\Http\Middleware\CommonItem;

use App\Models\CommonItem\CommonItemType;
use Closure;
use Illuminate\Http\Request;

class CommonItemCreate
{
    public function handle(Request $request, Closure $next)
    {
        if($request->new_type){
            $type   =   CommonItemType::where('name',$request->new_type)->first();
            if($type){
                return redirect()->back()->withCookie(cookie('error','Tip Zaten Kullanılıyor!',0.02));
            }
        }
        else{
            $type   =   CommonItemType::find($request->type_id);
            if($type==NULL){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
        }
        return $next($request);
    }
}
