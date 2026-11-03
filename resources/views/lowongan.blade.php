@extends('layouts.app')

@section('content')
    <div class="relative mx-auto max-w-6xl px-4 py-8 pb-24 font-sans">
        <div class="mb-6 flex items-center justify-end">
            <div class="flex items-center gap-2 text-sm font-bold text-slate-800">
                <span>Kalimantan Barat</span>
                <svg class="h-5 w-5 text-slate-800" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 10h12M9 16h6" />
                </svg>
            </div>
        </div>

        @foreach (['Part time', 'Full time'] as $type)
            <h2 class="mb-4 text-2xl font-bold text-slate-900">{{ $type }}</h2>
            <div class="mb-10 grid gap-4">
                @foreach ($jobs as $job)
                    @if (strtolower($job['type']) === strtolower($type))
                        <article id="job-{{ $job['id'] }}" data-job-id="{{ $job['id'] }}"
                            class="flex flex-col justify-between gap-5 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm md:flex-row md:items-center">
                            <div class="flex min-w-0 items-center gap-5">
                                <div @class([
                                    'flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl p-2',
                                    'bg-red-600' => $job['brand'] === "Hotway's",
                                    'bg-white' => $job['brand'] !== "Hotway's",
                                ])>
                                    @if ($job['image'])
                                        <img src="{{ asset('images/' . $job['image']) }}" alt="Logo {{ $job['brand'] }}"
                                            class="h-full w-full object-contain">
                                    @else
                                        <span class="text-center text-xl font-black {{ $job['logoClass'] }}">{{ $job['logo'] }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-slate-900">{{ $job['title'] }}</h3>
                                    <p class="mt-1 text-xs font-medium text-gray-400">
                                        {{ $job['company_location'] }} | {{ $job['company_pt'] }}
                                    </p>
                                    <div class="mt-3 space-y-1 text-xs font-semibold text-slate-700">
                                        <p>Mencari: <span class="font-normal text-gray-600">{{ $job['position'] }}</span></p>
                                        <p>Minimal Lulusan: <span class="font-normal text-gray-600">{{ $job['education'] }}</span></p>
                                        <p>Maksimal Umur: <span class="font-normal text-gray-600">{{ $job['age'] }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                                <div class="w-56">
                                    <div class="mb-1.5 flex justify-between text-xs font-bold">
                                        <span class="text-slate-800">Pelamar saat ini: {{ $job['applicants'] }}</span>
                                        <span class="text-gray-400">{{ $job['applicants'] }}/{{ $job['quota'] }}</span>
                                    </div>
                                    <div class="h-3 w-full rounded-full bg-amber-100">
                                        <div class="h-3 rounded-full bg-amber-500"
                                            style="width: {{ min(100, (int) round($job['applicants'] / $job['quota'] * 100)) }}%">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('job.detail', ['jobId' => $job['id']]) }}"
                                        class="rounded-xl bg-slate-950 px-7 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                                        View
                                    </a>
                                    <button type="button"
                                        class="rounded-xl bg-red-600 px-7 py-2 text-sm font-semibold text-white transition hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
