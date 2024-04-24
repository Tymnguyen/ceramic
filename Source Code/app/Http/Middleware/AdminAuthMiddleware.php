<?php

namespace App\Http\Middleware;

use App\Models\RoleFunction;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next, $param): Response
    {
        //Authenticate
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        //Authorize (0 is pages that dont need to authorize, just need to authenticate)
        if($param != 0){
            $userRoleId = Auth::guard('admin')->user()->roleid;
            $checkFunctionAuthorized = RoleFunction::where('deleted',0)->where('roleid',$userRoleId)->where('functionid',$param)->count();
            if($checkFunctionAuthorized == 0) return redirect()->route('admin.notauthorized');
        }

        return $next($request);
    }
}
