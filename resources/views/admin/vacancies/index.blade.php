@extends('layouts.admin')

@section('title', 'Lowongan Saya')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Lowongan Saya</h1>
            <p class="mt-2 text-sm text-gray-500">Lowongan dari perusahaan terverifikasi yang Anda miliki.</p>
        </div>
        <a href="{{ route('admin.vacancies.create') }}" class="rounded-full bg-[#151442] px-5 py-2.5 text-sm font-semibold text-white">+ Tambah Lowongan</a>
    </div>
    <div class="mt-7 space-y-4">
        @forelse ($vacancies as $vacancy)
            <article class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex min-w-0 items-center gap-4">
                    @if ($vacancy->image_url ?: $vacancy->company->logo_url)
                        <img src="{{ $vacancy->image_url ?: $vacancy->company->logo_url }}" alt=""
                            class="h-16 w-16 shrink-0 rounded-lg bg-white object-contain p-1">
                    @endif
                    <div class="min-w-0">
                    <h2 class="font-bold">{{ $vacancy->title }}</h2>
                    <p class="mt-1 text-xs text-gray-500">{{ $vacancy->company->name }} · {{ $vacancy->applications_count }} pelamar</p>
                    <p class="mt-1 text-xs text-gray-500">{{ $vacancy->status === 'published' ? 'Terbit' : 'Draft' }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="rounded-full border border-[#151442] px-4 py-2 text-xs font-semibold">Edit</a>
                    <form action="{{ route('admin.vacancies.destroy', $vacancy) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white">Arsipkan</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="rounded-2xl bg-white px-6 py-14 text-center text-sm text-gray-500">Belum ada lowongan di perusahaan terverifikasi Anda.</div>
        @endforelse
    </div>
    <div class="mt-6">{{ $vacancies->links() }}</div>
@endsection
