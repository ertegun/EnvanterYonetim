<?php

namespace App\Http\Middleware\Hardware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Hardware\HardwareType;

class HardwareTypeUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $control = HardwareType::find($request->id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        if($request->old_name == $request->name && $request->old_prefix == $request->prefix){
            return redirect()->back()->withCookie(cookie('error','Bir Değişiklik Yapmadınız!',0.02));
        }
        else{
            if($request->old_name != $request->name){
                $control = HardwareType::where('name',$request->name)->first();
                if($control != NULL){
                    return redirect()->back()->withCookie(cookie('error','Tip Adı Kullanılıyor!',0.02));
                }
            }
            if($request->old_prefix != $request->prefix){
                $control = HardwareType::where('prefix',$request->prefix)->first();
                if($control != NULL){
                    return redirect()->back()->withCookie(cookie('error','Tip Ön Eki Kullanılıyor!',0.02));
                }
            }
        }
        if($request->total_item <0){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
