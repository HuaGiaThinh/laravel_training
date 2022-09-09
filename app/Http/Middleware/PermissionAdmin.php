<?php
 
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
 
class PermissionAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->level == 'admin') {
            return $next($request);
        }
        // return redirect()->route('home');  
        return redirect()->route('not-permission');  
    }
}