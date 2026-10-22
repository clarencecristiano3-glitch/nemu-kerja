@extends('layouts.app')

@section('content')
<div class="relative max-w-6xl mx-auto px-4 py-8 font-sans pb-24">

    {{-- Region Filter --}}
    <div class="flex justify-end items-center mb-6">
        <div class="flex items-center gap-2 cursor-pointer font-bold text-slate-800 text-sm">
            <span>Kalimantan Barat</span>
            <svg class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 10h12M9 16h6" />
            </svg>
        </div>
    </div>

    {{-- Pengelompokan Otomatis Berdasarkan Tipe (Part time / Full time) --}}
    @php
        $groupedJobs = collect($jobs)->groupBy('type');
    @endphp

    @forelse($groupedJobs as $type => $jobList)
        {{-- Judul Tipe Pekerjaan (Part time / Full time) --}}
        <h2 class="text-2xl font-bold text-slate-900 mb-4 capitalize">{{ $type }}</h2>
        
        <div class="space-y-4 mb-10">
            @foreach($jobList as $job)
                @php
                    $applicants = $job['applicants'] ?? 0;
                    $maxApplicants = $job['max_applicants'] ?? 10;
                    $percentage = $maxApplicants > 0 ? min(100, round(($applicants / $maxApplicants) * 100)) : 0;
                @endphp

                {{-- Card Lowongan Dinamis --}}
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center space-x-5">
                        <div class="w-24 h-24 bg-red-600 rounded-2xl flex items-center justify-center p-2 flex-shrink-0">
                            <img src="{{ asset('images/' . ($job['image'] ?? 'default.png')) }}" 
                                 alt="{{ $job['company'] }}" 
                                 class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h3 class="font-extrabold text-xl text-slate-900">{{ $job['company'] }} - {{ $job['type'] }}</h3>
                            <p class="text-xs text-gray-400 mt-1 font-medium">{{ $job['location'] }} | {{ $job['company_pt'] ?? $job['company'] }}</p>
                            <div class="mt-3 text-xs text-slate-700 space-y-1 font-semibold">
                                <p>Mencari : <span class="font-normal text-gray-600">{{ $job['position'] }}</span></p>
                                <p>Minimal Lulusan : <span class="font-normal text-gray-600">{{ $job['education'] }}</span></p>
                                <p>Maximal Umur : <span class="font-normal text-gray-600">{{ $job['age'] }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-8">
                        {{-- Progress Bar Pelamar --}}
                        <div class="w-56">
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span class="text-slate-800">Pelamar saat ini : {{ $applicants }}</span>
                                <span class="text-gray-400">{{ $applicants }}/{{ $maxApplicants }}</span>
                            </div>
                            <div class="w-full bg-amber-100 rounded-full h-3">
                                <div class="bg-amber-500 h-3 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>

                        {{-- Tombol Tindakan --}}
                        <div class="flex space-x-2">
                            <a href="{{ route('job.detail', $job['id'] ?? 1) }}" class="bg-slate-950 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-slate-800 transition">View</a>
                            <button type="button" class="bg-red-600 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-red-700 transition">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="py-12 text-center text-gray-400">
            <p>Belum ada lowongan pekerjaan yang tersedia.</p>
        </div>
    @endforelse

</div>
@endsection