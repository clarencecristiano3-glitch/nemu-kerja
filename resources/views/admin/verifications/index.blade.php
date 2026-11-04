@extends('layouts.admin')

@section('title', 'Verifikasi Perusahaan')

@section('content')
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Verifikasi Perusahaan</h1>
        <p class="mt-2 text-sm text-gray-500">Setujui atau tolak perusahaan. Hanya perusahaan yang disetujui yang dapat menerbitkan lowongan publik.</p>
    </div>

    <form method="GET" class="mt-5">
        <label class="text-xs font-semibold">Status
            <select name="status" onchange="this.form.submit()" class="ml-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs">
                @foreach (['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </form>

    <div class="mt-7 space-y-5">
        @forelse ($companies as $company)
            <article class="flex flex-col gap-5 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:p-5">
                <div class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-red-50">
                    @if ($company->logo_url)
                        <img src="{{ $company->logo_url }}" alt="Logo {{ $company->name }}" class="h-full w-full object-contain p-2">
                    @else
                        <span class="text-3xl font-extrabold">{{ str($company->name)->substr(0, 1)->upper() }}</span>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-xl font-extrabold">{{ $company->name }}</h2>
                        <span class="rounded-full bg-amber-50 px-3 py-1 text-[10px] font-semibold text-amber-800">{{ ucfirst($company->verification_status) }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">{{ $company->legal_name ?: 'Badan usaha belum diisi' }} · {{ $company->region }}</p>
                    <p class="mt-2 text-xs leading-relaxed text-gray-600">
                        Pemilik: {{ $company->owner_name ?: '—' }} · Outlet: {{ $company->outlets_count }} · Terhubung ke {{ $company->vacancies_count }} lowongan
                    </p>
                    @if ($company->review_note)
                        <p class="mt-2 text-xs text-gray-500">Catatan terakhir: {{ $company->review_note }}</p>
                    @endif
                </div>
                <form action="{{ route('admin.verifications.update', $company) }}" method="POST" class="flex shrink-0 flex-wrap items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="review_note" value="{{ old('review_note', $company->review_note) }}" maxlength="2000"
                        aria-label="Catatan verifikasi" placeholder="Catatan (opsional)" class="w-40 rounded-full border border-gray-200 px-3 py-2 text-xs">
                    <button name="verification_status" value="approved" class="rounded-full bg-green-600 px-4 py-2 text-xs font-semibold text-white hover:bg-green-700">Setujui</button>
                    <button name="verification_status" value="rejected" class="rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white hover:bg-red-700">Tolak</button>
                </form>
            </article>
        @empty
            <div class="rounded-2xl bg-white px-6 py-16 text-center text-sm text-gray-500">Belum ada perusahaan untuk diverifikasi.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $companies->links() }}</div>
@endsection
