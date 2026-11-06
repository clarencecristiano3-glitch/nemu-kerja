@extends('layouts.admin')

@section('title', 'Dashboard Perusahaan')

@section('content')
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#ef9d00]">Panel Pengelola</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight">Dashboard Perusahaan</h1>
        <p class="mt-2 text-sm text-gray-500">Ringkasan ini hanya mencakup perusahaan dan lowongan milik Anda.</p>
    </div>
    <section class="mt-8 grid gap-4 sm:grid-cols-2">
        <a href="{{ route('admin.vacancies.index') }}" class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs text-gray-500">Lowongan Saya</p>
            <p class="mt-3 text-3xl font-extrabold">{{ number_format($vacancyCount) }}</p>
        </a>
        <a href="{{ route('admin.applications.index') }}" class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs text-gray-500">Lamaran Masuk</p>
            <p class="mt-3 text-3xl font-extrabold">{{ number_format($applicationCount) }}</p>
        </a>
    </section>
    <section class="mt-8 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
        <h2 class="text-lg font-bold">Lowongan Terbaru</h2>
        <div class="mt-4 divide-y divide-gray-100">
            @forelse ($recentVacancies as $vacancy)
                <div class="py-4">
                    <p class="font-semibold">{{ $vacancy->title }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ $vacancy->company->name }} · {{ $vacancy->applications_count }} pelamar</p>
                </div>
            @empty
                <p class="py-6 text-sm text-gray-500">Belum ada lowongan di perusahaan terverifikasi Anda.</p>
            @endforelse
        </div>
    </section>
@endsection
