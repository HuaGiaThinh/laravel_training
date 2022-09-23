<?php
 
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
 
class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check())  return redirect()->back();
        // if (Auth::check())  return redirect()->route('home');
 
        return $next($request);
    }
}