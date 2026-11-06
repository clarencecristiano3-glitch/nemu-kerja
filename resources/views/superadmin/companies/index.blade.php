@extends('layouts.superadmin')

@section('title', 'Semua Perusahaan')

@section('content')
    <h1 class="text-3xl font-extrabold">Semua Perusahaan</h1>
    <p class="mt-2 text-sm text-gray-500">Termasuk perusahaan lama, pengajuan baru, dan data pemiliknya.</p>
    <div class="mt-7 space-y-3">
        @forelse ($companies as $company)
            <article class="rounded-2xl bg-white p-5 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="font-bold">{{ $company->name }}</h2>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold">{{ ucfirst($company->status) }}</span>
                </div>
                <p class="mt-2 text-xs text-gray-500">{{ $company->region }} · Pemilik: {{ $company->owner?->username ?? 'Data lama tanpa pemilik' }} · {{ $company->vacancies_count }} lowongan</p>
                <a href="{{ route('superadmin.verifications.show', $company) }}" class="mt-3 inline-block text-xs font-semibold text-[#151442] underline">Detail / verifikasi</a>
            </article>
        @empty
            <p class="rounded-2xl bg-white p-8 text-sm text-gray-500">Belum ada data perusahaan.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $companies->links() }}</div>
@endsection
