<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar - Nemu Kerja!</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans antialiased">
	<div class="min-h-screen">
		@include('layouts.navbar')

		<div class="flex min-h-[calc(100vh-61px)] flex-col justify-between p-6 sm:p-10">

		<main class="mx-auto my-auto grid w-full max-w-5xl grid-cols-1 items-center gap-8 py-6 lg:grid-cols-12">
			<div class="w-full max-w-md lg:col-span-6">
				<h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
					Daftar <span class="text-[#f59e0b]">Nemu Kerja!</span>
				</h1>
				<p class="mt-2 text-sm text-gray-500">Mulai perjalanan karier impianmu, daftar sekarang gratis!</p>

				@if ($errors->any())
					<div class="mt-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
						role="alert">
						<ul class="list-disc space-y-1 pl-5">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form action="{{ route('register') }}" method="POST" class="mt-8 space-y-5">
					@csrf
					<div>
						<label for="username"
							class="mb-1.5 ml-1 block text-xs font-medium text-gray-600">Username</label>
						<input type="text" name="username" id="username" value="{{ old('username') }}"
							autocomplete="username" required autofocus
							class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
					</div>
					<div>
						<label for="password"
							class="mb-1.5 ml-1 block text-xs font-medium text-gray-600">Password</label>
						<input type="password" name="password" id="password" autocomplete="new-password" required
							class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
					</div>
					<div>
						<label for="password_confirmation"
							class="mb-1.5 ml-1 block text-xs font-medium text-gray-600">Konfirmasi Password</label>
						<input type="password" name="password_confirmation" id="password_confirmation"
							autocomplete="new-password" required
							class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
					</div>
					<div>
						<label for="age" class="mb-1.5 ml-1 block text-xs font-medium text-gray-600">Umur
							Pengguna</label>
						<select name="age" id="age" required
							class="w-full appearance-none rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
							<option value="" disabled {{ old('age') ? '' : 'selected' }}>Pilih umur</option>
							@for ($age = 13; $age <= 100; $age++)
								<option value="{{ $age }}" {{ old('age') == $age ? 'selected' : '' }}>{{ $age }} tahun
								</option>
							@endfor
						</select>
					</div>
					<div class="pt-3">
						<button type="submit"
							class="w-44 rounded-full bg-[#181838] py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#101028] active:scale-95">Daftar</button>
					</div>
				</form>

				<p class="mt-5 text-center text-sm text-gray-500 sm:text-left">
					Sudah punya akun?
					<a href="{{ route('login') }}" class="font-semibold text-[#151442] hover:text-[#f59e0b]">Masuk</a>
				</p>
			</div>

			<div class="relative hidden justify-end lg:col-span-6 lg:flex">
				<div class="relative h-[480px] w-[320px]">
					<div class="absolute inset-0 overflow-hidden rounded-[32px] bg-[#0e1248] shadow-2xl">
						<div class="absolute -bottom-10 -left-16 h-80 w-80 rounded-full bg-[#ffb800]"></div>
					</div>
					<img src="{{ asset('images/robot.png') }}" alt="Maskot roket Nemu Kerja!"
						class="pointer-events-none absolute -left-[360px] top-1/2 z-20 w-[640px] max-w-none -translate-y-1/2 object-contain drop-shadow-2xl">
				</div>
			</div>
		</main>
		</div>
	</div>
</body>

</html>