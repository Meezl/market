<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionClearanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasRole('Admin'))
        {
            return $next($request);
        }
        if (Auth::user()->hasRole('User'))
        {
            if ($request->is('product/create'))
            {
                if (!Auth::user()->hasPermissionTo('Create Product'))
                {
                    abort('401');
                }
                else {
                    return $next($request);
                }
            }
            if ($request->is('products/'))
            {
                if (!Auth::user()->hasPermissionTo('View Products'))
                {
                    abort('401');
                }
                else {
                    return $next($request);
                }
            }
            if ($request->is('products/edit')){
                if(!Auth::user()->hasPermissionTo('Edit product')){
                    abort('401');
                } else {
                    return $next($request);
                }
            }

        }
        return $next($request);
    }
}