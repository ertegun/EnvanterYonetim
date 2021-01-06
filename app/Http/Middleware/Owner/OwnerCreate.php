<?php

namespace App\Http\Middleware\Owner;

use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemOwner;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareOwner;
use App\Models\Material\Material;
use App\Models\Material\MaterialOwner;
use App\Models\Software\Software;
use App\Models\Software\SoftwareOwner;
use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;

class OwnerCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control = User::find($request->user_id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata1!',0.02));
        }
        if(!isset($request->hardwares) && !isset($request->softwares) && !isset($request->commons) && !isset($request->materials)){
            return redirect()->back()->withCookie(cookie('error','Hiç Seçim Yapmadınız!',0.02));
        }
        else{
            if(isset($request->hardwares)){
                foreach($request->hardwares as $item){
                    $control = Hardware::where('id',$item)->first();
                    if($control == NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                    $control = HardwareOwner::where('hardware_id',$item)->first();
                    if($control != NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                }
            }
            if(isset($request->softwares)){
                foreach($request->softwares as $item){
                    $control = Software::find($item);
                    if($control == NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                    $control = SoftwareOwner::where('software_id',$item)->first();
                    if($control != NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                }
            }
            if(isset($request->commons)){
                foreach($request->commons as $item){
                    $control = CommonItem::find($item);
                    if($control == NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                    $user_id = $request->user_id;
                    $control = CommonItemOwner::where('owner_id',$user_id)
                    ->where('common_item_id',$item)->first();
                    if($control != NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                }
            }
            if(isset($request->materials)){
                foreach($request->materials as $item){
                    $control = Material::find($item);
                    if($control == NULL){
                        return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata!',0.02));
                    }
                }
            }
        }
        return $next($request);
    }
}
