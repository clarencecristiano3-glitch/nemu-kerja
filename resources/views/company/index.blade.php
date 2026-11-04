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
            <article id="company-{{ $company->id }}" class="company-card">
                <div class="company-info">
                    <div class="logo-box">
                        @if ($company->logo_url)
                            <img src="{{ $company->logo_url }}" alt="Logo {{ $company->name }}">
                        @else
                            <span>{{ str($company->name)->substr(0, 1)->upper() }}</span>
                        @endif
                    </div>
                    <div class="company-copy">
                        <div class="region">{{ $company->region }}</div>
                        <h2>{{ $company->name }}</h2>
                        <dl>
                            <div><dt>Jumlah Outlet</dt><dd>: {{ $company->outlets_count }}</dd></div>
                            <div><dt>Pemilik</dt><dd>: {{ $company->owner_name ?: '—' }}</dd></div>
                        </dl>
                    </div>
                </div>
                <a href="#company-{{ $company->id }}" class="check-company">Perusahaan Terverifikasi</a>
            </article>
        @endforeach
    </div>

    <div class="see-more"><span></span><a href="#">see more</a><span></span></div>
    <div>{{ $companies->links() }}</div>
</section>
@endsection
