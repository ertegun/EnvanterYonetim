<?php

namespace App\Http\Middleware\Type;

use Closure;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $control    =    Type::find($request->type_id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Güncelleme Sırasında Bir Hata Oluştu!',0.02));
        }
        //Değişiklik durumda 4 tane ihtimal var!
        if($request->old_type_prefix!=$request->type_prefix){//Eski ön ek yenisi ile aynı değilse girer
            if($request->old_type_name!=$request->type_name){//Eski ad yeni ad ile aynı değilse girer
                $control    =   Type::where('name',$request->type_name)->orWhere('prefix',$request->type_prefix)->count();
                if($control>0){
                    return redirect()->back()->withCookie(cookie('error','Tip Ön Eki veya Tip Adı Kullanılıyor!',0.02));
                }
                return $next($request);
            }
            else{//Eski ad yeni ad ile aynıysa girer
                $control    =   Type::where('prefix',$request->type_prefix)->count();
                if($control>0){
                    return redirect()->back()->withCookie(cookie('error','Tip Ön Eki Kullanılıyor!',0.02));
                }
                return $next($request);
            }
        }
        else{//Eski ön ek yeni ön ek ile aynıysa girer
            if($request->old_type_name!=$request->type_name){//Eski ad yeni ad ile aynı değilse girer
                $control    =   Type::where('name',$request->type_name)->orWhere('prefix',$request->type_prefix)->count();
                if($control>0){
                    return redirect()->back()->withCookie(cookie('error','Tip Adı Kullanılıyor!',0.02));
                }
                return $next($request);
            }
            else{//Eski ad yeni ad ile aynıysa girer
                return redirect()->back()->withCookie(cookie('error','Giriş Yapmadınız!',0.02));
            }
        }
    }
}
