<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#191950">
    <title>@yield('title', 'Daftar Perusahaan — Nemu Kerja')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/company.css') }}">
</head>
<body>
    @include('partials.navbar')
    <main>@yield('content')</main>
    @include('partials.footer')
</body>
</html>
