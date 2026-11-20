<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:'.Carbon::now()->subYears(13)->toDateString(),
                'after_or_equal:'.Carbon::now()->subYears(100)->toDateString(),
            ],
        ], [
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan garis bawah.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'birth_date.before_or_equal' => 'Umur pengguna minimal 13 tahun.',
            'birth_date.after_or_equal' => 'Tanggal lahir tidak valid.',
        ]);

        $user = User::create([
            'name' => $validated['username'],
            'username' => $validated['username'],
            'email' => $validated['username'].'@nemu-kerja.local',
            'password' => $validated['password'],
            'birth_date' => $validated['birth_date'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat!');
    }
}
