<?php

namespace App\Http\Middleware\Hardware;

use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareModel;
use App\Models\Hardware\HardwareType;
use Closure;
use Illuminate\Http\Request;

class HardwareCreate
{
    public function handle(Request $request, Closure $next)
    {
        if($request->new_type && $request->new_type_prefix){
            $type = HardwareType::where('name',$request->new_type)->orWhere('prefix',$request->new_type_prefix)->first();
            if($type){
                return redirect()->back()->withCookie(cookie('error','Tip Adı ve ya Tip Ön Eki Kullanılıyor!',0.02));
            }
            $prefix = $request->new_type_prefix;
        }
        else{
            $type =   HardwareType::find($request->type_id);
            if($type==NULL){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
            $prefix = $type->prefix;
        }
        if($request->new_model){
            $model = HardwareModel::where('name',$request->new_model)->first();
            if($model){
                return redirect()->back()->withCookie(cookie('error','Bu Model Zaten Mevcut!',0.02));
            }
        }
        else{
            $model = HardwareModel::find($request->model_id);
            if($model==NULL){
                return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
            }
        }
        if($request->barcode_number){
            $barcode_number = $prefix.$request->barcode_number;
            $control    =   Hardware::where('barcode_number',$barcode_number)->count();
            if($control>0){
                return redirect()->back()->withInput()->withCookie(cookie('error','Barkod Numarası Kullanılıyor!',0.02));
            }
        }
        if(isset($request->serial_number)){
            $control    =   Hardware::where('serial_number',$request->serial_number)->count();
            if($control>0){
                return redirect()->back()->withInput()->withCookie(cookie('error','Seri Numarası Kullanılıyor!',0.02));
            }
        }
        if($request->duration<1 || $request->duration>10){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
