@extends('layouts.app')

@section('title', $company->name . ' — Nemu Kerja')

@section('content')
    <section class="mx-auto max-w-5xl px-5 py-10 lg:px-0">
        <a href="{{ route('companies.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#151442]">← Kembali ke daftar perusahaan</a>

        <div class="mt-5 flex flex-wrap items-center gap-5 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-gray-100 bg-white">
                @if ($company->logo_url)
                    <img src="{{ $company->logo_url }}" alt="Logo {{ $company->name }}" class="h-full w-full object-contain">
                @else
                    <span class="text-4xl font-black text-[#151442]">{{ str($company->name)->substr(0, 1)->upper() }}</span>
                @endif
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">{{ $company->region }}</p>
                <h1 class="mt-1 text-3xl font-extrabold text-[#151442]">{{ $company->name }}</h1>
                <p class="mt-2 text-sm text-gray-500">{{ $company->legal_name ?: $company->name }} · {{ $company->outlets_count }} outlet</p>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="mb-8 text-2xl font-bold text-[#151442] lg:text-3xl">Lowongan dari {{ $company->name }}</h2>
            @if (count($jobs) > 0)
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($jobs as $job)
                        <a id="job-{{ $job['id'] }}" href="{{ route('job.detail', ['jobId' => $job['id']]) }}"
                            class="block overflow-hidden rounded-xl border border-gray-100 bg-white shadow-lg transition hover:-translate-y-1 hover:shadow-xl">
                            <div @class([
                                'flex h-[296px] items-center justify-center p-3 text-center',
                                'bg-red-600' => $job['logoBackground'],
                                'bg-white' => ! $job['logoBackground'],
                            ])>
                                @if ($job['image'])
                                    <img src="{{ $job['image'] }}" alt="Logo {{ $job['brand'] }}"
                                        class="h-full w-full object-contain">
                                @else
                                    <span class="text-4xl font-black {{ $job['logoClass'] }}">{{ $job['logo'] }}</span>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="mb-3 text-sm font-extrabold">{{ $job['company'] }}</h3>
                                <p class="text-xs leading-5">Mencari : {{ $job['position'] }}</p>
                                <p class="text-xs leading-5">Minimal Lulusan : {{ $job['education'] }}</p>
                                <p class="text-xs leading-5">Maksimal Umur : {{ $job['age'] }}</p>
                                <p class="mt-3 text-right text-[10px] text-gray-500">
                                    {{ $job['needed'] }} orang di butuhkan
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-gray-100 bg-white px-6 py-12 text-center text-sm text-gray-500">
                    Perusahaan ini belum memiliki lowongan yang sedang dibuka.
                </div>
            @endif
        </div>
    </section>
@endsection
