<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Nemu Kerja!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans antialiased">

    <div class="flex min-h-screen flex-col justify-between p-6 sm:p-10">

        <a href="{{ route('login') }}" class="flex items-center">
            <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-10 w-auto">
        </a>

        <div class="mx-auto my-auto grid w-full max-w-5xl grid-cols-1 items-center gap-8 py-6 lg:grid-cols-12">

            <div class="w-full max-w-md lg:col-span-6">
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Masuk <span class="text-[#f59e0b]">Nemu Kerja!</span>
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Masuk sekarang, jemput karier impianmu hari ini!
                </p>

                <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-5">
                    @csrf

                    <div>
                        <label for="username" class="mb-1.5 ml-1 block text-xs font-medium text-gray-600">
                            Username
                        </label>
                        <input type="text" name="username" id="username"
                            class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                            required>
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 ml-1 block text-xs font-medium text-gray-600">
                            Password
                        </label>
                        <input type="password" name="password" id="password"
                            class="w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                            required>
                    </div>

                    <div class="pt-3">
                        <button type="submit"
                            class="w-44 rounded-full bg-[#181838] py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#101028] active:scale-95">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>

            <div class="relative hidden justify-end lg:col-span-6 lg:flex">
                <div class="relative h-[480px] w-[320px] translate-x-20 -translate-y-6">
                    <div class="relative hidden justify-end lg:col-span-6 lg:flex">
                        <div class="relative h-[480px] w-[320px]">
                            <div class="absolute inset-0 overflow-hidden rounded-[32px] bg-[#0e1248] shadow-2xl">
                                <div class="absolute -bottom-10 -left-16 h-80 w-80 rounded-full bg-[#ffb800]"></div>
                            </div>
                            <img src="{{ asset('images/robot.png') }}" alt="Rocket Mascot"
                                class="pointer-events-none absolute -left-[360px] top-1/2 z-20 w-[640px] max-w-none -translate-y-1/2 object-contain drop-shadow-2xl">
                        </div>
                    </div>

                    <!-- Spacer Bawah -->
                    <div class="hidden lg:block"></div>
                </div>

</body>

</html>