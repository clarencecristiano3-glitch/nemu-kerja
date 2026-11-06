@extends('layouts.admin')

@section('title', 'Detail Lamaran')

@section('content')
    <a href="{{ route('admin.applications.index') }}" class="text-xs font-semibold text-gray-500">← Kembali ke lamaran</a>
    <div class="mt-4 grid gap-5 lg:grid-cols-[1fr_360px]">
        <section class="rounded-2xl bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-extrabold">{{ $application->full_name }}</h1>
            <p class="mt-2 text-sm text-gray-500">{{ $application->vacancy?->company?->name }} · {{ $application->vacancy?->title }}</p>
            <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                <div><dt class="text-xs text-gray-500">Umur</dt><dd class="text-sm">{{ $application->age }}</dd></div>
                <div><dt class="text-xs text-gray-500">Pendidikan</dt><dd class="text-sm">{{ $application->education }}</dd></div>
                <div><dt class="text-xs text-gray-500">Email</dt><dd class="text-sm">{{ $application->email }}</dd></div>
            </dl>
            <h2 class="mt-7 font-bold">Dokumen lamaran</h2>
            @foreach ($application->documents as $document)
                <a class="mt-2 block text-sm underline" href="{{ route('admin.application-documents.show', $document) }}" target="_blank" rel="noopener">{{ $document->original_name }}</a>
            @endforeach
        </section>
        <form action="{{ route('admin.applications.update', $application) }}" method="POST" class="h-fit space-y-3 rounded-2xl bg-white p-6 shadow-sm">
            @csrf
            @method('PATCH')
            <label class="block text-xs font-semibold">Catatan<textarea name="review_note" rows="4" maxlength="2000" class="mt-2 w-full rounded-xl border border-gray-200 p-3 text-sm">{{ old('review_note', $application->review_note) }}</textarea></label>
            <button name="status" value="reviewed" class="w-full rounded-full bg-green-600 px-4 py-3 text-xs font-semibold text-white">Tandai terverifikasi</button>
            <button name="status" value="rejected" class="w-full rounded-full bg-red-600 px-4 py-3 text-xs font-semibold text-white">Tolak lamaran</button>
        </form>
    </div>
@endsection
