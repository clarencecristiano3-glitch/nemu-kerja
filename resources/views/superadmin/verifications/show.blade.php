@extends('layouts.superadmin')

@section('title', 'Detail Verifikasi')

@section('content')
    <a href="{{ route('superadmin.verifications.index') }}" class="text-sm font-semibold text-gray-500">← Kembali ke verifikasi</a>
    <section class="mt-5 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="text-3xl font-extrabold">{{ $company->name }}</h1>
            <span class="rounded-full bg-amber-50 px-4 py-2 text-xs font-semibold">{{ ucfirst($company->status) }}</span>
        </div>
        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            <div><dt class="text-xs text-gray-500">Nama badan usaha</dt><dd class="mt-1">{{ $company->legal_name ?: '—' }}</dd></div>
            <div><dt class="text-xs text-gray-500">Wilayah</dt><dd class="mt-1">{{ $company->region }}</dd></div>
            <div><dt class="text-xs text-gray-500">Pemilik akun</dt><dd class="mt-1">{{ $company->owner?->username ?? 'Data lama tanpa pemilik' }}</dd></div>
            <div><dt class="text-xs text-gray-500">Nama pemilik</dt><dd class="mt-1">{{ $company->owner_name ?: '—' }}</dd></div>
            <div><dt class="text-xs text-gray-500">Outlet</dt><dd class="mt-1">{{ $company->outlets_count }}</dd></div>
            <div><dt class="text-xs text-gray-500">Lowongan terkait</dt><dd class="mt-1">{{ $company->vacancies_count }}</dd></div>
        </dl>
        @if ($company->document_path)
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('superadmin.verifications.document', $company) }}" target="_blank" rel="noopener" class="rounded-full border border-[#151442] px-4 py-2 text-sm font-semibold">Preview dokumen</a>
                <a href="{{ route('superadmin.verifications.document', ['company' => $company, 'download' => 1]) }}" class="rounded-full border border-[#151442] px-4 py-2 text-sm font-semibold">Download dokumen</a>
            </div>
        @else
            <p class="mt-6 text-sm text-gray-500">Dokumen verifikasi tidak tersedia untuk data lama ini.</p>
        @endif
        @if ($company->rejection_reason)
            <p class="mt-4 rounded-xl bg-red-50 p-4 text-sm text-red-800">Alasan penolakan: {{ $company->rejection_reason }}</p>
        @endif
        @if ($company->owner_id !== null)
            <form action="{{ route('superadmin.verifications.update', $company) }}" method="POST" class="mt-8 border-t border-gray-100 pt-6">
                @csrf
                @method('PATCH')
                <label class="block text-xs font-semibold">Alasan penolakan (wajib saat menolak)
                    <textarea name="rejection_reason" rows="3" maxlength="2000" class="mt-2 w-full rounded-xl border border-gray-200 p-3 text-sm">{{ old('rejection_reason') }}</textarea>
                </label>
                <div class="mt-4 flex flex-wrap gap-3">
                    <button name="status" value="verified" class="rounded-full bg-green-600 px-5 py-3 text-sm font-semibold text-white">Verifikasi</button>
                    <button name="status" value="rejected" class="rounded-full bg-red-600 px-5 py-3 text-sm font-semibold text-white">Tolak</button>
                </div>
            </form>
        @endif
    </section>
@endsection
