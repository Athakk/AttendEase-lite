<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login() {
        return view('auth.login');
    }

    function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::where('email', $credentials['email'])->first();

            if ($user->level == 'admin') {
                return redirect()->intended(route('dashboard'))->with('success', 'Berhasil login');
            } else {
                return redirect()->intended(route('user.absensi'))->with('success', 'Berhasil login');
            }
            
        }
        return redirect()->route('login')->with('error', 'Email atau password anda salah');
    }
    
    function register() {
        return view('auth.register');
    }

    function createRegister(Request $request) {
        $request->validate([
            'name' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'password' => 'required',
            'avatar' => 'nullable'
        ]);

        $request['avatar'] = 'oioi';
        $request['level'] = 'user';
        $request['password'] = bcrypt($request['password']);

        User::create($request->all());
        
        return redirect()->route('register')->with('success', 'Berhasil membuat akun!');
    }

    function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
