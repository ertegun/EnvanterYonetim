<?php

namespace App\Http\Middleware\User;

use App\Models\User\Department;
use Closure;
use Illuminate\Http\Request;
use App\Models\User\User;

class UserCreate
{
    public function handle(Request $request, Closure $next)
    {
        $email      =   $request->email;
        $email     .=   "@gruparge.com";
        $control    =   User::where("email",$email)->first();

        if($control!= NULL){
            return redirect()->back()->withInput()->withCookie(cookie('error', 'E-Mail Kullanılıyor!',0.02));
        }
        if($request->new_department){
            $control = Department::where('name',$request->new_department)->first();
            if($control != NULL){
                return redirect()->back()->withInput()->withCookie(cookie('error', 'Departman Zaten Mevcut!',0.02));
            }
        }
        else{
            $control =  Department::find($request->department_id);
            if($control == NULL){
                return redirect()->back()->withInput()->withCookie(cookie('error', 'İşlem Sırasında Hata!',0.02));
            }
        }
        return $next($request);
    }
}
