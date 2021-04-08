<?php

namespace App\Http\Middleware;

use App\Helpers\Stage;
use Closure;

use Illuminate\Support\Arr;
use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;

class AuthAdminArea
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            $user = \Auth::user();

            $authorized = [UserType::ADMINISTRATOR, UserType::APPRAISER, UserType::ROOT];

            $userHasPermission = in_array($user->level, $authorized);

            if ($userHasPermission) {
                return $next($request);
            } else {
                return redirect('login');
            }
        }

//    }
}
