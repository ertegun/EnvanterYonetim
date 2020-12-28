<?php

namespace App\Http\Middleware\Hardware;

use App\Models\Hardware\Hardware;
use Closure;
use Illuminate\Http\Request;

class HardwareDelete
{
    public function handle(Request $request, Closure $next)
    {
        $control    =   Hardware::where('barcode_number',$request->barcode_number)->count();
        if($control==0){
            return redirect()->back()->withCookie(cookie('error','Silme İşlemi Sırasında Hata Oluştu!',0.02));
        }
        return $next($request);
    }
}
