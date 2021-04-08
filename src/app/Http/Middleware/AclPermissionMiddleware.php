<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;

class AclPermissionMiddleware
{
    public function handle($request, Closure $next, $AclPermissions)
    {
        $WherePermissions = explode('|', $AclPermissions);
        $EntityPermissions = Permission::WhereIn('name', $WherePermissions);

        foreach ($EntityPermissions as $permission){
            if ($permission->hasLevel($request->user()->level))
                return $next($request);
            else
                return redirect('login');
        }
    }
}
