<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;

class AdminDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Admin::find($request->admin_id);
        if($control==NULL){
            return redirect()->route('admin')->withCookie(cookie('error', 'Silme İşlemi Başarısız!',0.02));
        }
        return $next($request);
    }
}
