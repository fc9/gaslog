<?php

namespace App\Http\Middleware;

use Closure;

use App\Enums\UserType;

class AclLevelMiddleware
{
    public function handle($request, Closure $next, $levelsPermission)
    {
        $levels = explode('|', $levelsPermission);
        $levels = array_map("UserType::FromKey", $levels);
        if (in_array($request->user()->level, $levels))
            return $next($request);
       else
            return redirect('login');
    }
}
