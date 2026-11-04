@extends('layouts.admin')

@section('title', 'Verifikasi Lamaran')

@section('content')
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Verifikasi Lamaran</h1>
        <p class="mt-2 text-sm text-gray-500">Periksa data pelamar dan dokumen yang dikirim untuk setiap lowongan.</p>
    </div>

    <form method="GET" class="mt-5">
        <label class="text-xs font-semibold">Status
            <select name="status" onchange="this.form.submit()" class="ml-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs">
                @foreach (['pending' => 'Menunggu', 'reviewed' => 'Terverifikasi', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </form>

    <div class="mt-7 space-y-7">
        @forelse ($applicationsByCompany as $companyName => $companyApplications)
            <section>
                <h2 class="mb-3 text-lg font-extrabold">{{ $companyName }}</h2>
                <div class="space-y-3">
                    @foreach ($companyApplications as $application)
                        <a href="{{ route('admin.applications.show', $application) }}"
                            class="block rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:border-[#ed9d00]">
                            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-start">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-base font-extrabold">{{ $application->full_name }}</h3>
                                        <span @class([
                                            'rounded-full px-3 py-1 text-[10px] font-semibold',
                                            'bg-amber-50 text-amber-800' => $application->status === 'pending',
                                            'bg-green-50 text-green-800' => $application->status === 'reviewed',
                                            'bg-red-50 text-red-800' => $application->status === 'rejected',
                                        ])>{{ ['pending' => 'Menunggu', 'reviewed' => 'Terverifikasi', 'rejected' => 'Ditolak'][$application->status] }}</span>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">{{ $application->vacancy?->title ?? $application->job_title }}</p>
                                </div>
                                <div class="text-xs text-gray-500 sm:text-right">
                                    <p>{{ $application->age }} tahun · {{ $application->education }}</p>
                                    <p class="mt-1">{{ $application->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="rounded-2xl bg-white px-6 py-16 text-center text-sm text-gray-500">Belum ada lamaran pada status ini.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $applications->links() }}</div>
@endsection
