<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\Department;

class UserUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $new_user_email =   $request->email;
        $new_user_email.=   "@gruparge.com";

        $user   =   User::select()->find($request->id);
        if($user->email!=$new_user_email){
            $control    =   User::select()->where("email",$new_user_email)->count();
            if($control>0){
                return redirect()->back()->withCookie(cookie('error', 'E-Mail Kullanılıyor!',0.02));
            }
        }
        if($request->new_department){
            $control = Department::where('name',$request->new_department)->first();
            if($control != NULL){
                return redirect()->back()->withCookie(cookie('error', 'Departman Zaten Mevcut!',0.02));
            }
        }
        else{
            $control =  Department::find($request->department_id);
            if($control == NULL){
                return redirect()->back()->withCookie(cookie('error', 'İşlem Sırasında Hata!',0.02));
            }
        }
        return $next($request);
    }
}
