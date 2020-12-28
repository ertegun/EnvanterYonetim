<?php

namespace App\Http\Middleware\Software;

use Closure;
use Illuminate\Http\Request;
use App\Models\Software\SoftwareType;

class SoftwareTypeUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $control =   SoftwareType::find($request->id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        if($request->old_name == $request->name){
            return redirect()->back()->withCookie(cookie('error','Değişiklik Yapmadınız!',0.02));
        }
        else{
            $control =   SoftwareType::where('name',$request->name)->first();
            if($control!=NULL){
                return redirect()->back()->withCookie(cookie('error','Tür Adı Kullanılıyor!',0.02));
            }
        }
        return $next($request);
    }
}
