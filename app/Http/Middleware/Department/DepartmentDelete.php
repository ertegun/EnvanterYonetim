<?php

namespace App\Http\Middleware\Department;

use App\Models\User\Department;
use Closure;
use Illuminate\Http\Request;

class DepartmentDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Department::find($request->id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','İşlem Sırasında Hata Oluştu!',0.02));
        }
        $control    =   Department::find($request->id)->getUserCount();
        if($control>0){
            return redirect()->back()->withCookie(cookie('error','Departman Silme Başarısız!',0.02));
        }
        return $next($request);
    }
}
