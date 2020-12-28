<?php

namespace App\Http\Middleware\Owner;

use App\Models\Software\SoftwareOwner;
use Closure;
use Illuminate\Http\Request;

class SoftwareDrop
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   SoftwareOwner::where('software_id',$request->software_id)->where('owner_id',$request->user_id)->first();
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
