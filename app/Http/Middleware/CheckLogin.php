<?php
 
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
 
class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check())  return redirect()->route('home');
        // if (Auth::check())  return redirect()->intended('home');
 
        return $next($request);
    }
}