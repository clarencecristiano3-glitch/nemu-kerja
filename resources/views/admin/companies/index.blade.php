@extends('layouts.admin')

@section('title', 'Daftar Perusahaan')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Daftar Perusahaan</h1>
            <p class="mt-2 text-sm text-gray-500">Kelola profil perusahaan dan data yang terhubung ke lowongan.</p>
        </div>
        <a href="{{ route('admin.companies.create') }}" class="rounded-full bg-[#151442] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#25236b]">
            + Tambah Perusahaan
        </a>
    </div>

    <div class="mt-7 space-y-4">
        @forelse ($companies as $company)
            <article class="flex flex-col gap-5 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:p-5">
                <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-gray-50">
                    @if ($company->logo_url)
                        <img src="{{ $company->logo_url }}" alt="Logo {{ $company->name }}" class="h-full w-full object-contain p-2">
                    @else
                        <span class="text-2xl font-extrabold">{{ str($company->name)->substr(0, 1)->upper() }}</span>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-lg font-extrabold">{{ $company->name }}</h2>
                        <span @class([
                            'rounded-full px-3 py-1 text-[10px] font-semibold',
                            'bg-green-50 text-green-700' => $company->verification_status === 'approved',
                            'bg-red-50 text-red-700' => $company->verification_status === 'rejected',
                            'bg-amber-50 text-amber-700' => $company->verification_status === 'pending',
                        ])>{{ ucfirst($company->verification_status) }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">{{ $company->legal_name ?: 'Badan usaha belum diisi' }} · {{ $company->region }}</p>
                    <p class="mt-2 text-xs text-gray-600">{{ $company->outlets_count }} outlet · {{ $company->vacancies_count }} lowongan · Pemilik: {{ $company->owner_name ?: '—' }}</p>
                </div>
                <div class="flex shrink-0 flex-wrap gap-2">
                    <a href="{{ route('admin.companies.edit', $company) }}" class="rounded-full border border-[#151442] px-4 py-2 text-xs font-semibold hover:bg-[#151442] hover:text-white">Edit</a>
                    <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Hapus perusahaan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="rounded-2xl bg-white px-6 py-16 text-center text-sm text-gray-500">Belum ada data perusahaan.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $companies->links() }}</div>
@endsection
