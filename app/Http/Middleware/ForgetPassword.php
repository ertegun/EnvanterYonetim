<?php

namespace App\Http\Middleware;

use App\Models\Admin\Admin;
use App\Models\Reset;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ForgetPassword
{
    public function handle(Request $request, Closure $next)
    {
        $email =   $request->email;
        $email.=   "@gruparge.com";
        $admin    =   Admin::where("email",$email)->first();
        if($admin == NULL){
            return redirect()->back()->withCookie(cookie('error', 'Bu E-Mail\'e Kayıtlı Yetkili Bulunmamaktadır!',0.02));
        }
        $control = Reset::where('admin_id',$admin->id)->orderByDesc('created_at')->first();
        if($control != NULL){
            $minute      =   Carbon::createFromFormat('Y-m-d H:i:s',$control->created_at)
            ->diffInMinutes();
            if($minute <= 30){
                return redirect()->back()->withCookie(cookie('error', '30 DK İçerisinde Zaten İstek Göndermişsiniz!',0.02));
            }
        }
        return $next($request);
    }
}
