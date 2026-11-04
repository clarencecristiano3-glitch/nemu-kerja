@extends('layouts.admin')

@section('title', 'Daftar Lowongan')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Daftar Lowongan</h1>
            <p class="mt-2 text-sm text-gray-500">Setiap lowongan terhubung dengan perusahaan melalui ID perusahaan.</p>
        </div>
        <a href="{{ route('admin.vacancies.create') }}" class="rounded-full bg-[#151442] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#25236b]">+ Tambah Lowongan</a>
    </div>

    <div class="mt-7 space-y-9">
        @forelse ($vacancies->getCollection()->groupBy('employment_type') as $employmentType => $groupedVacancies)
            <section>
                <h2 class="mb-4 text-xl font-extrabold">{{ $employmentType }}</h2>
                <div class="space-y-4">
        @foreach ($groupedVacancies as $vacancy)
            <article class="flex flex-col gap-5 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:p-5">
                <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-xl {{ $vacancy->company->slug === 'hotways-chicken' ? 'bg-red-600' : 'bg-gray-50' }}">
                    @if ($vacancy->company->logo_url)
                        <img src="{{ $vacancy->company->logo_url }}" alt="Logo {{ $vacancy->company->name }}" class="h-full w-full object-contain p-2">
                    @else
                        <span class="text-2xl font-extrabold">{{ str($vacancy->company->name)->substr(0, 1)->upper() }}</span>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-lg font-extrabold">{{ $vacancy->title }}</h2>
                        <span @class([
                            'rounded-full px-3 py-1 text-[10px] font-semibold',
                            'bg-green-50 text-green-700' => $vacancy->status === 'published',
                            'bg-gray-100 text-gray-600' => $vacancy->status === 'draft',
                        ])>{{ $vacancy->status === 'published' ? 'Terbit' : 'Draft' }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">{{ $vacancy->company->name }} · {{ $vacancy->company->region }} · {{ $vacancy->employment_type }}</p>
                    <p class="mt-2 text-xs">Mencari: {{ $vacancy->position }} · Pendidikan: {{ $vacancy->minimum_education }} · Maks. umur: {{ $vacancy->maximum_age }}</p>
                    <div class="mt-3 flex max-w-md items-center gap-3">
                        <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-[#f8e8bf]">
                            <div class="h-full rounded-full bg-[#ed9d00]" style="width: {{ min(100, (int) round($vacancy->applications_count / max(1, $vacancy->quota) * 100)) }}%"></div>
                        </div>
                        <span class="text-[10px] text-gray-500">{{ $vacancy->applications_count }}/{{ $vacancy->quota }} pelamar</span>
                    </div>
                </div>
                <div class="flex shrink-0 flex-wrap gap-2">
                    @if ($vacancy->status === 'published' && $vacancy->company->verification_status === 'approved')
                        <a href="{{ route('job.detail', ['jobId' => $vacancy->id]) }}" class="rounded-full bg-[#08083f] px-5 py-2 text-xs font-semibold text-white">Lihat</a>
                    @endif
                    <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="rounded-full border border-[#151442] px-4 py-2 text-xs font-semibold hover:bg-[#151442] hover:text-white">Edit</a>
                    <form action="{{ route('admin.vacancies.destroy', $vacancy) }}" method="POST" onsubmit="return confirm('Arsipkan lowongan ini? Data lamaran tetap disimpan.')">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
            </div>
            </section>
        @empty
            <div class="rounded-2xl bg-white px-6 py-16 text-center text-sm text-gray-500">Belum ada lowongan.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $vacancies->links() }}</div>
@endsection
