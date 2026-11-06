<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Superadmin') - Nemu Kerja!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f7f7fb] text-[#151442] antialiased">
    @include('layouts.superadmin-navbar')
    <main class="mx-auto min-h-[65vh] max-w-[1500px] px-5 py-8 lg:px-10 lg:py-10">
        @if (session('success'))
            <p class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="status">{{ session('success') }}</p>
        @endif
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
