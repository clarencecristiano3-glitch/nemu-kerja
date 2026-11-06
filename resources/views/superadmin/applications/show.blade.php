@extends('layouts.superadmin')

@section('title', 'Detail Lamaran')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <a href="{{ route('superadmin.applications.index') }}" class="text-xs font-semibold text-[#6b6988] hover:text-[#151442]">← Kembali ke verifikasi lamaran</a>
            <h1 class="mt-3 text-3xl font-extrabold tracking-tight">{{ $application->full_name }}</h1>
            <p class="mt-2 text-sm text-gray-500">{{ $application->vacancy?->company?->name ?? $application->company_name }} · {{ $application->vacancy?->title ?? $application->job_title }}</p>
        </div>
        <span @class([
            'rounded-full px-4 py-2 text-xs font-semibold',
            'bg-amber-50 text-amber-800' => $application->status === 'pending',
            'bg-green-50 text-green-800' => $application->status === 'reviewed',
            'bg-red-50 text-red-800' => $application->status === 'rejected',
        ])>{{ ['pending' => 'Menunggu', 'reviewed' => 'Terverifikasi', 'rejected' => 'Ditolak'][$application->status] }}</span>
    </div>

    <div class="mt-7 grid gap-5 lg:grid-cols-[1fr_360px]">
        <section class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
            <h2 class="text-lg font-extrabold">Data Pelamar</h2>
            <dl class="mt-5 grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs text-gray-500">Nama lengkap</dt><dd class="mt-1 text-sm font-semibold">{{ $application->full_name }}</dd></div>
                <div><dt class="text-xs text-gray-500">Umur</dt><dd class="mt-1 text-sm font-semibold">{{ $application->age }} tahun</dd></div>
                <div><dt class="text-xs text-gray-500">Pendidikan terakhir</dt><dd class="mt-1 text-sm font-semibold">{{ $application->education }}</dd></div>
                <div><dt class="text-xs text-gray-500">Email</dt><dd class="mt-1 break-all text-sm font-semibold">{{ $application->email }}</dd></div>
                <div><dt class="text-xs text-gray-500">Username akun</dt><dd class="mt-1 text-sm font-semibold">{{ $application->user?->username ?? 'Akun sudah tidak tersedia' }}</dd></div>
                <div><dt class="text-xs text-gray-500">Tanggal melamar</dt><dd class="mt-1 text-sm font-semibold">{{ $application->created_at->format('d M Y, H:i') }}</dd></div>
            </dl>

            <h2 class="mt-8 text-lg font-extrabold">Dokumen Lamaran</h2>
            <ul class="mt-4 space-y-3">
                @forelse ($application->documents as $document)
                    <li class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-gray-100 px-4 py-3">
                        <div>
                            <p class="text-sm font-semibold">{{ $document->original_name }}</p>
                            <p class="mt-1 text-xs text-gray-500">{{ $document->document_type === 'cv' ? 'CV / Surat lamaran' : 'Dokumen pendukung' }} · {{ number_format($document->size_bytes / 1024, 0) }} KB</p>
                        </div>
                        <a href="{{ route('superadmin.application-documents.show', $document) }}" target="_blank" rel="noopener"
                            class="rounded-full bg-[#151442] px-4 py-2 text-xs font-semibold text-white hover:bg-[#211f5d]">Buka file</a>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">Tidak ada dokumen tersimpan.</li>
                @endforelse
            </ul>
        </section>

        <aside class="h-fit rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="text-lg font-extrabold">Tindak Lanjut</h2>
            @if ($application->reviewed_at)
                <p class="mt-2 text-xs text-gray-500">Diperbarui {{ $application->reviewed_at->format('d M Y, H:i') }} oleh {{ $application->reviewer?->username ?? 'admin' }}</p>
            @endif
            @if ($application->review_note)
                <p class="mt-3 rounded-xl bg-gray-50 p-3 text-xs text-gray-600">{{ $application->review_note }}</p>
            @endif

            <form action="{{ route('superadmin.applications.update', $application) }}" method="POST" class="mt-5 space-y-3">
                @csrf
                @method('PATCH')
                <label for="review_note" class="block text-xs font-semibold">Catatan (opsional)</label>
                <textarea id="review_note" name="review_note" rows="4" maxlength="2000"
                    class="w-full rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:border-[#151442]">{{ old('review_note', $application->review_note) }}</textarea>
                <button name="status" value="reviewed" class="w-full rounded-full bg-green-600 px-4 py-3 text-xs font-semibold text-white hover:bg-green-700">Tandai Terverifikasi</button>
                <button name="status" value="rejected" class="w-full rounded-full bg-red-600 px-4 py-3 text-xs font-semibold text-white hover:bg-red-700">Tolak Lamaran</button>
            </form>
        </aside>
    </div>
@endsection
