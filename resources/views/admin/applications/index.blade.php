@extends('layouts.admin')

@section('title', 'Lamaran Perusahaan Saya')

@section('content')
    <h1 class="text-3xl font-extrabold">Lamaran Perusahaan Saya</h1>
    <form method="GET" class="mt-5">
        <label class="text-xs font-semibold">Status
            <select name="status" onchange="this.form.submit()" class="ml-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs">
                @foreach (['pending' => 'Menunggu', 'reviewed' => 'Terverifikasi', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </form>
    <div class="mt-7 space-y-6">
        @forelse ($applicationsByCompany as $companyName => $companyApplications)
            <section>
                <h2 class="mb-3 text-lg font-bold">{{ $companyName }}</h2>
                <div class="space-y-3">
                    @foreach ($companyApplications as $application)
                        <a href="{{ route('admin.applications.show', $application) }}" class="block rounded-2xl bg-white p-5 shadow-sm hover:ring-1 hover:ring-[#ef9d00]">
                            <p class="font-bold">{{ $application->full_name }}</p>
                            <p class="mt-1 text-xs text-gray-500">{{ $application->vacancy?->title ?? $application->job_title }} · {{ ucfirst($application->status) }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="rounded-2xl bg-white px-6 py-14 text-center text-sm text-gray-500">Belum ada lamaran untuk perusahaan Anda.</div>
        @endforelse
    </div>
    <div class="mt-6">{{ $applications->links() }}</div>
@endsection
