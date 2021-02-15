<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Hash;

class AdminUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $admin   =   Admin::find($request->admin_id);
        if($admin == NULL){
            return redirect()->back()->withCookie(cookie('error', 'İşlem Sırasında Hata!',0.02));
        }
        $control =  Role::find($request->role_id);
        if($control == NULL){
            return redirect()->back()->withCookie(cookie('error', 'İşlem Sırasında Hata!',0.02));
        }
        $password = Hash::check($request->current_password, $admin->password);
        if(!$password){
            return redirect()->back()->withCookie(cookie('error', 'Şifre Hatalı!',0.02));
        }
        $new_admin_email =   $request->email;
        $new_admin_email.=   "@gruparge.com";
        if($new_admin_email == $admin->email && $request->user_name == $admin->user_name &&
         $request->name == $admin->name && $request->role_id == $admin->role_id){
            return redirect()->back()->withCookie(cookie('error', 'Değişiklik Yapmadınız!',0.02));
        }
        if($admin->user_name != $request->user_name){
            $control    =    Admin::where('user_name',$request->user_name)->count();
            if($control>0){
                return redirect()->back()->withCookie(cookie('error', 'Kullanıcı Adında Yetkili Mevcut!',0.02));
            }
        }
        if($admin->email!=$new_admin_email){
            $control    =   Admin::where("email",$new_admin_email)->count();
            if($control>0){
                return redirect()->back()->withCookie(cookie('error', 'E-Mail Kullanılıyor!',0.02));
            }
        }
        return $next($request);
    }
}
