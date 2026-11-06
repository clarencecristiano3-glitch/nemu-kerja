@extends('layouts.superadmin')

@section('title', 'Dashboard Superadmin')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#ef9d00]">Panel Pengelola</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight">Dashboard Superadmin</h1>
            <p class="mt-2 text-sm text-gray-500">Ringkasan seluruh perusahaan, akun, lowongan, verifikasi, dan lamaran.</p>
        </div>
        <a href="{{ route('superadmin.vacancies.create') }}" class="rounded-full bg-[#151442] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#25236b]">
            + Tambah Lowongan
        </a>
    </div>

    <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ([
            ['Total Lowongan', $vacancyCount, route('superadmin.vacancies.index')],
            ['Perusahaan', $companyCount, route('superadmin.companies.index')],
            ['Menunggu Verifikasi', $pendingCompanyCount, route('superadmin.verifications.index')],
            ['Tips Karier', $careerTipCount, route('superadmin.career-tips.index')],
            ['Lamaran Masuk', $applicationCount, route('superadmin.applications.index')],
            ['Pengguna', $userCount, route('superadmin.users.index')],
        ] as [$label, $count, $url])
            <a href="{{ $url }}" class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <p class="text-xs font-medium text-gray-500">{{ $label }}</p>
                <p class="mt-3 text-3xl font-extrabold">{{ number_format($count) }}</p>
            </a>
        @endforeach
    </section>

    <section class="mt-8 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold">Lowongan Terbaru</h2>
                <p class="mt-1 text-xs text-gray-500">Status dan perusahaan terkait.</p>
            </div>
            <a href="{{ route('superadmin.vacancies.index') }}" class="text-xs font-semibold text-[#151442] hover:text-[#ef9d00]">Lihat semua</a>
        </div>

        <div class="mt-5 divide-y divide-gray-100">
            @forelse ($recentVacancies as $vacancy)
                <div class="flex flex-wrap items-center justify-between gap-3 py-4">
                    <div>
                        <p class="font-semibold">{{ $vacancy->title }}</p>
                        <p class="mt-1 text-xs text-gray-500">{{ $vacancy->company->name }} · {{ $vacancy->employment_type }} · {{ $vacancy->applications_count }} pelamar</p>
                    </div>
                    <span @class([
                        'rounded-full px-3 py-1 text-[10px] font-semibold',
                        'bg-green-50 text-green-700' => $vacancy->status === 'published',
                        'bg-amber-50 text-amber-700' => $vacancy->status !== 'published',
                    ])>{{ $vacancy->status === 'published' ? 'Terbit' : 'Draft' }}</span>
                </div>
            @empty
                <p class="py-8 text-center text-sm text-gray-500">Belum ada lowongan.</p>
            @endforelse
        </div>
    </section>
@endsection
