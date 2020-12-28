<?php

namespace App\Http\Middleware\Software;

use Closure;
use Illuminate\Http\Request;
use App\Models\Software\SoftwareType;
use App\Models\Software\Software;

class SoftwareUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $control =   Software::find($request->id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        if(isset($request->new_type)){
            $control =   SoftwareType::where('name',$request->new_type)->first();
            if($control!=NULL){
                return redirect()->back()->withCookie(cookie('error','Bu Tür Zaten Kullanılıyor!',0.02));
            }
        }
        else{
            $control =   SoftwareType::find($request->type_id);
            if($control==NULL){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
        }
        if(isset($request->license_time)){
            if($request->license_time <= 0){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
        }
        return $next($request);
    }
}
