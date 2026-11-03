@extends('layouts.app')

@section('title', 'Daftar Perusahaan — Nemu Kerja')

@section('content')
<section class="companies-page">
    <div class="hero">
        <h1><span>Daftar</span> <strong>Perusahaan</strong></h1>
        <p>di N E M U  K E R J A</p>
    </div>

    <div class="companies-grid">
        @foreach ($companies as $company)
            <article class="company-card">
                <div class="company-info">
                    <div class="logo-box"><img src="{{ asset('images/' . $company['logo']) }}" alt="Logo {{ $company['name'] }}"></div>
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
</section>
@endsection
