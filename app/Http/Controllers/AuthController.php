<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json(
                ['data' => 'success', 'user' => auth()->user()]
            );

            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return response()->json(
            ['data' => 'failed', 'user' => null]
        );

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logOut()
    {
        return auth()->logout();
    }

}
