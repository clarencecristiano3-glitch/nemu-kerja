<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Cek ke database pakai Auth::attempt
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/home')->with('success', 'Berhasil login!');
        }

        // 3. Jika gagal, kembalikan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
}