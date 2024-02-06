<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        $logoPath = asset('images/Logo.png');

        return inertia('CustomAuth/Login', [
            'logoPath' => $logoPath,
        ]);
    }

    public function authenticate(Request $request)
    {
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)) {
            // $user = User::where('id', Auth::user()->id)->first();

            // dd($user);
        } else {
            return back()->withErrors([
                'username' => 'These credentials do not match our records.'
            ]);
        }   
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login')->with('success', 'You have been logged out!');
    }
}
