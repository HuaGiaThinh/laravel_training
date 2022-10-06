<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'     => 'required|string|email',
            'password'  => 'required|string|max:60',
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => 'active'];

        if (Auth::attempt($credentials)) { 
            User::where('id', Auth::id())->update(['last_login' => now()]);
            return redirect()->intended();
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }

    public function home()
    {
        return view('home');
    }
}
