<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#191950">
    <title>Daftar Perusahaan - Nemu Kerja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/company.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .company-card {
            min-height: 225px;
            padding: 28px 30px 26px;
        }

        .company-info {
            gap: 24px;
        }

        .logo-box {
            width: 104px;
            height: 104px;
        }

        .logo-box img {
            max-width: 84px;
            max-height: 84px;
        }

        .company-copy .region {
            font-size: 13px;
        }

        .company-copy h2 {
            font-size: 26px;
        }

        .company-copy dl {
            font-size: 13px;
            line-height: 1.7;
        }

        .check-company {
            padding: 11px 24px;
            font-size: 13px;
        }

        @media (max-width: 680px) {
            .company-card {
                min-height: 210px;
                padding: 22px;
            }

            .company-info {
                gap: 18px;
            }

            .logo-box {
                width: 88px;
                height: 88px;
            }

            .logo-box img {
                max-width: 70px;
                max-height: 70px;
            }

            .company-copy h2 {
                font-size: 22px;
            }

            .company-copy dl {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <main class="companies-page">
        <div class="hero">
            <h1><span>Daftar</span> <strong>Perusahaan</strong></h1>
            <p>di N E M U K E R J A</p>
        </div>

        <div class="companies-grid">
            @foreach ($companies as $company)
                <article class="company-card">
                    <div class="company-info">
                        <div class="logo-box">
                            <img src="{{ asset('images/' . $company['logo']) }}" alt="Logo {{ $company['name'] }}">
                        </div>
                        <div class="company-copy">
                            <div class="region">{{ $company['region'] }}</div>
                            <h2>{{ $company['name'] }}</h2>
                            <dl>
                                <div><dt>Jumlah Outlet</dt><dd>: {{ $company['outlets'] }}</dd></div>
                                <div><dt>Pemilik</dt><dd>: {{ $company['owner'] }}</dd></div>
                            </dl>
                        </div>
                    </div>
                    <a href="#" class="check-company">Cek Perusahaan</a>
                </article>
            @endforeach
        </div>

        <div class="see-more"><span></span><a href="#">see more</a><span></span></div>
    </main>

        <!-- Footer External -->
        @include('partials.footer')
        
</body>
</html>
