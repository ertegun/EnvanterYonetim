<?php

namespace App\Http\Middleware\Department;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\Department;

class DepartmentCreate
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Department::where('name',$request->name)->count();
        if($control>0){
            return redirect()->back()->withCookie(cookie('error','Bu İsimde Departman Bulunmakda!',0.02));
        }
        return $next($request);
    }
}
