@extends('layouts.superadmin')

@section('title', 'Verifikasi Perusahaan')

@section('content')
    <h1 class="text-3xl font-extrabold">Verifikasi Perusahaan</h1>
    <p class="mt-2 text-sm text-gray-500">Periksa dokumen dan verifikasi kepemilikan perusahaan.</p>
    <form method="GET" class="mt-5">
        <label class="text-xs font-semibold">Status
            <select name="status" onchange="this.form.submit()" class="ml-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs">
                @foreach (['pending' => 'Menunggu', 'verified' => 'Terverifikasi', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </form>
    <div class="mt-7 space-y-4">
        @forelse ($companies as $company)
            <article class="rounded-2xl bg-white p-5 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-lg font-bold">{{ $company->name }}</h2>
                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold">{{ ucfirst($company->status) }}</span>
                </div>
                <p class="mt-2 text-sm text-gray-500">{{ $company->legal_name ?: $company->region }} · Pemilik: {{ $company->owner?->username ?? 'Data lama tanpa pemilik' }}</p>
                <p class="mt-1 text-xs text-gray-500">{{ $company->vacancies_count }} lowongan · {{ $company->verifiedBy?->username ? 'Diperiksa oleh '.$company->verifiedBy->username : 'Belum diperiksa' }}</p>
                <a href="{{ route('superadmin.verifications.show', $company) }}" class="mt-4 inline-block rounded-full bg-[#151442] px-4 py-2 text-xs font-semibold text-white">Buka detail</a>
            </article>
        @empty
            <p class="rounded-2xl bg-white p-8 text-sm text-gray-500">Tidak ada perusahaan pada status ini.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $companies->links() }}</div>
@endsection
