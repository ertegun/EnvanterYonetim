<?php

namespace App\Http\Middleware\Department;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\Department;

class DepartmentUpdate
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Department::find($request->id);
        if($control==NULL){
            return redirect()->back()->withCookie(cookie('error','Birim Adı Değiştirme Başarısız!',0.02));
        }
        if($request->old_name != $request->name){
            $control    =   Department::where('name',$request->name)->count();
            if($control>0){
                return redirect()->back()->withCookie(cookie('error','Bu İsimde Departman Bulunmakda!',0.02));
            }
        }
        else{
            return redirect()->back()->withCookie(cookie('error','Değişiklik Yapmadınız!',0.02));
        }
        return $next($request);
    }
}
