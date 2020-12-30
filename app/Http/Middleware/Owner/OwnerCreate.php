<?php

namespace App\Http\Middleware\Owner;

use App\Models\Owner;
use Closure;
use Illuminate\Http\Request;

class OwnerCreate
{
    public function handle(Request $request, Closure $next)
    {

        return $next($request);
    }
}
