<?php

namespace App\Http\Middleware\Hardware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareType;
use App\Models\Hardware\HardwareModel;

class HardwareUpdate
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
            $prefix =  $type->prefix;
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
        $control    =   Hardware::where('barcode_number',$request->old_barcode_number);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        $control    =   Hardware::where('serial_number',$request->old_serial_number);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        if($request->serial_number != NULL){
            $old_serial_number = Hardware::select('serial_number')->where('barcode_number',$request->old_barcode_number)->first()->serial_number;
            if($request->serial_number!=$old_serial_number){
                $control    =   Hardware::where('serial_number',$request->serial_number)->count();
                if($control>0){
                    return redirect()->back()->withInput()->withCookie(cookie('error','Seri Numarası Kullanılıyor!',0.02));
                }
            }
        }
        $barcode_number = $prefix.$request->barcode_number;
        if($barcode_number!=$request->old_barcode_number){
            $control    =   Hardware::where('barcode_number',$barcode_number)->count();
            if($control>0){
                return redirect()->back()->withInput()->withCookie(cookie('error','Barkod Numarası Kullanılıyor!',0.02));
            }
        }
        if($request->duration<1 || $request->duration>10){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
        }
        return $next($request);
    }
}
