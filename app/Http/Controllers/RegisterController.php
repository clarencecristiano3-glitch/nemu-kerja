<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
			'age' => ['required', 'integer', 'min:13', 'max:100'],
		], [
			'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan garis bawah.',
			'password.confirmed' => 'Konfirmasi password tidak cocok.',
			'age.min' => 'Umur pengguna minimal 13 tahun.',
		]);

		$user = User::create([
			'name' => $validated['username'],
			'username' => $validated['username'],
			'email' => $validated['username'].'@nemu-kerja.local',
			'password' => $validated['password'],
			'age' => $validated['age'],
		]);

		Auth::login($user);
		$request->session()->regenerate();

		return redirect()->route('home')->with('success', 'Akun berhasil dibuat!');
	}
}
