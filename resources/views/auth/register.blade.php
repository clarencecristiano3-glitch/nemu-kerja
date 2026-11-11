<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Nemu Kerja!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col justify-between bg-white font-sans text-[#151442] antialiased">

    <!-- HEADER / LOGO + TOMBOL KEMBALI -->
    <header class="w-full">
        <div class="mx-auto flex max-w-[1500px] flex-col items-start px-6 pt-3 pb-2 lg:px-10">
            <a href="{{ route('home') }}" class="inline-flex items-center">
                <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-9 w-auto">
            </a>
            
            <!-- Tombol Back ke Home -->
            <a href="{{ route('home') }}" class="mt-2 inline-flex items-center gap-1.5 text-xs font-medium text-gray-500 transition hover:text-[#151442]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <!-- CONTAINER UTAMA -->
    <main class="mx-auto my-auto w-full max-w-[1500px] px-6 py-8 lg:px-10">
        <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2">

            <!-- KOLOM KIRI: Form Register -->
            <div class="w-full max-w-md">
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-[38px] sm:leading-tight">
                    Daftar <span class="text-[#f59e0b]">Nemu Kerja!</span>
                </h1>
                <p class="mt-2.5 text-sm text-gray-500">
                    Mulai perjalanan karier impianmu, daftar sekarang gratis!
                </p>

                {{-- Notifikasi Error Jika Register Gagal --}}
                @if ($errors->any())
                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-3 text-xs text-red-600">
                        <ul class="list-disc space-y-1 pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="username" class="mb-1.5 ml-1 block text-xs font-semibold text-gray-600">
                            Username
                        </label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" autocomplete="username" required autofocus
                            class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 ml-1 block text-xs font-semibold text-gray-600">
                            Password
                        </label>
                        <input type="password" name="password" id="password" autocomplete="new-password" required
                            class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1.5 ml-1 block text-xs font-semibold text-gray-600">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" required
                            class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                    </div>

                    <div>
                        <label for="age" class="mb-1.5 ml-1 block text-xs font-semibold text-gray-600">
                            Umur Pengguna
                        </label>
                        <select name="age" id="age" required
                            class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                            <option value="" disabled {{ old('age') ? '' : 'selected' }}>Pilih umur</option>
                            @for ($age = 13; $age <= 100; $age++)
                                <option value="{{ $age }}" {{ old('age') == $age ? 'selected' : '' }}>{{ $age }} tahun</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Tautan Masuk -->
                    <p class="pt-1 ml-1 text-xs text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#f59e0b] hover:underline">
                            Masuk
                        </a>
                    </p>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-44 rounded-full bg-[#151442] py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#101028] active:scale-95">
                            Daftar
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOLOM KANAN: Kartu & Maskot 3D -->
            <div class="relative hidden justify-end lg:flex">
                <div class="relative h-[460px] w-[310px]">
                    
                    <!-- Kartu Biru & Overlay Oranye (Presisi GPU Clipping) -->
                    <div class="absolute inset-0 isolate overflow-hidden rounded-[32px] bg-[#0e1248] shadow-2xl transform-gpu">
                        <!-- Layer 1: Background Kartu Biru Pattern Panda -->
                        <img src="{{ asset('images/kotak_biru.jpg') }}" alt="Card Background" class="h-full w-full scale-110 object-cover rounded-[32px]">

                        <!-- Layer 2: Overlay Lingkaran Oranye -->
                        <img src="{{ asset('images/lingkaran_orange.png') }}" alt="Circle Accent" class="pointer-events-none absolute inset-0 h-full w-full object-cover rounded-[32px]">
                    </div>
                    
                    <!-- Maskot Robot -->
                    <img 
                        src="{{ asset('images/robot.png') }}" 
                        alt="Rocket Mascot" 
                        class="pointer-events-none absolute -left-[340px] top-1/2 z-20 w-[610px] max-w-none -translate-y-1/2 object-contain drop-shadow-2xl"
                    >
                </div>
            </div>

        </div>
    </main>

    <!-- Bottom Spacing -->
    <div class="py-2"></div>

</body>

</html>