<?php

namespace App\Http\Middleware\Owner;

use App\Models\CommonItem\CommonItemOwner;
use Closure;
use Illuminate\Http\Request;

class CommonDrop
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   CommonItemOwner::where('common_item_id',$request->common_item_id)->where('owner_id',$request->user_id)->first();
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
