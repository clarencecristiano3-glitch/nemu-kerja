@extends('layouts.app')

@section('title', 'Perusahaan Saya')

@section('content')
    <section class="mx-auto max-w-5xl px-5 py-10 lg:px-0">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#151442]">Perusahaan Saya</h1>
                <p class="mt-2 text-sm text-gray-500">Kelola pengajuan dan profil perusahaan yang Anda miliki.</p>
            </div>
            <a href="{{ route('company.profile.create') }}" class="rounded-full bg-[#151442] px-5 py-3 text-sm font-semibold text-white">Tambah Perusahaan</a>
        </div>

        <div class="mt-7 space-y-4">
            @forelse ($companies as $company)
                <a href="{{ route('company.profile.show', $company) }}" class="block rounded-2xl border border-gray-100 bg-white p-5 shadow-sm hover:border-[#ef9d00]">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h2 class="text-lg font-bold text-[#151442]">{{ $company->name }}</h2>
                        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800">
                            {{ ['pending' => 'Menunggu verifikasi', 'verified' => 'Terverifikasi', 'rejected' => 'Ditolak'][$company->status] ?? ucfirst($company->status) }}
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">{{ $company->legal_name ?: $company->region }} · {{ $company->vacancies_count }} lowongan</p>
                    @if ($company->rejection_reason)
                        <p class="mt-3 text-sm text-red-700">Alasan penolakan: {{ $company->rejection_reason }}</p>
                    @endif
                </a>
            @empty
                <div class="rounded-2xl bg-white px-6 py-14 text-center text-sm text-gray-500">Anda belum memiliki perusahaan. Tambahkan perusahaan untuk mengajukan verifikasi.</div>
            @endforelse
        </div>
        <div class="mt-6">{{ $companies->links() }}</div>
    </section>
@endsection
