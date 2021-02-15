<?php

namespace App\Http\Middleware\Owner;

use App\Models\CommonItem\CommonItemOwner;
use App\Models\Hardware\HardwareOwner;
use App\Models\Material\MaterialOwner;
use App\Models\Software\SoftwareOwner;
use App\Models\User\User;
use App\Models\Vehicle\VehicleOwner;
use Closure;
use Illuminate\Http\Request;

class ChangeIssueTime
{
    public function handle(Request $request, Closure $next)
    {
        if(!User::find($request->user_id)){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!1',0.02));
        }
        if(!strtotime($request->old_issue_time)){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!2',0.02));
        }
        if($request->issue_time == $request->old_issue_time){
            return redirect()->back()->withCookie(cookie('error','Bir Değişiklik Yapmadınız!',0.02));
        }
        $item_type  =   $request->item_type;
        if($item_type == 'hardware' || $item_type == 'software' || $item_type == 'common' || $item_type == 'material' || $item_type == 'vehicle'){
            if($item_type == 'hardware'){
                $control = HardwareOwner::where('hardware_id',$request->item_id)->where('owner_id',$request->user_id)->first();
                if($control == NULL){
                    return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!3',0.02));
                }
            }
            else if($item_type == 'software'){
                $control = SoftwareOwner::where('software_id',$request->item_id)->where('owner_id',$request->user_id)->first();
                if($control == NULL){
                    return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!4',0.02));
                }
            }
            else if($item_type == 'common'){
                $control = CommonItemOwner::where('common_item_id',$request->item_id)->where('owner_id',$request->user_id)->first();
                if($control == NULL){
                    return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!5',0.02));
                }
            }
            else if($item_type == 'material'){
                $control = MaterialOwner::where('id',$request->item_id)->where('owner_id',$request->user_id)->first();
                if($control == NULL){
                    return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!6',0.02));
                }
            }
            else{
                $control = VehicleOwner::where('vehicle_id',$request->item_id)->where('owner_id',$request->user_id)->first();
                if($control == NULL){
                    return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!7',0.02));
                }
            }
        }
        else{
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!8',0.02));
        }
        return $next($request);
    }
}
