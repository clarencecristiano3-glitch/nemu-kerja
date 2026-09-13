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

    {{-- PART TIME SECTION --}}
    <h2 class="text-2xl font-bold text-slate-900 mb-4">Part time</h2>
    
    <div class="space-y-4 mb-10">
        {{-- Card 1: Hotway's Chicken --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="flex items-center space-x-5">
                <div class="w-24 h-24 bg-red-600 rounded-2xl flex items-center justify-center p-2 flex-shrink-0">
                    <img src="{{ asset('images/hotway_chicken.png') }}" alt="Hotway's Chicken" class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="font-extrabold text-xl text-slate-900">Hotway's Chicken - Part time</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Pontianak, Jalan Merdeka No 23 | PT Lingga Jaya Utama</p>
                    <div class="mt-3 text-xs text-slate-700 space-y-1 font-semibold">
                        <p>Mencari : <span class="font-normal text-gray-600">Pelayan</span></p>
                        <p>Minimal Lulusan : <span class="font-normal text-gray-600">SMA/SMK</span></p>
                        <p>Maximal Umur : <span class="font-normal text-gray-600">24</span></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <div class="w-56">
                    <div class="flex justify-between text-xs font-bold mb-1.5">
                        <span class="text-slate-800">Pelamar saat ini : 7</span>
                        <span class="text-gray-400">7/10</span>
                    </div>
                    <div class="w-full bg-amber-100 rounded-full h-3">
                        <div class="bg-amber-500 h-3 rounded-full" style="width: 70%"></div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('job.detail') }}" class="bg-slate-950 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-slate-800 transition">View</a>
                    <button type="button" class="bg-red-600 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-red-700 transition">Delete</button>
                </div>
            </div>
        </div>

        {{-- Card 2: Ayam Budi --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="flex items-center space-x-5">
                <div class="w-24 h-24 bg-red-600 rounded-2xl flex items-center justify-center p-2 flex-shrink-0">
                    <img src="{{ asset('images/ayam budi.jpg') }}" alt="Ayam Budi" class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="font-extrabold text-xl text-slate-900">Ayam Budi - Part time</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Pontianak, Jalan Merdeka No 23 | PT Lingga Jaya Utama</p>
                    <div class="mt-3 text-xs text-slate-700 space-y-1 font-semibold">
                        <p>Mencari : <span class="font-normal text-gray-600">Pelayan</span></p>
                        <p>Minimal Lulusan : <span class="font-normal text-gray-600">SMA/SMK</span></p>
                        <p>Maximal Umur : <span class="font-normal text-gray-600">24</span></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <div class="w-56">
                    <div class="flex justify-between text-xs font-bold mb-1.5">
                        <span class="text-slate-800">Pelamar saat ini : 8</span>
                        <span class="text-gray-400">8/10</span>
                    </div>
                    <div class="w-full bg-amber-100 rounded-full h-3">
                        <div class="bg-amber-500 h-3 rounded-full" style="width: 80%"></div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('job.detail') }}" class="bg-slate-950 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-slate-800 transition">View</a>
                    <button type="button" class="bg-red-600 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-red-700 transition">Delete</button>
                </div>
            </div>
        </div>

        {{-- Card 3: Jojo Juice --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="flex items-center space-x-5">
                <div class="w-24 h-24 bg-red-600 rounded-2xl flex items-center justify-center p-2 flex-shrink-0">
                    <img src="{{ asset('images/jojo_juice.png') }}" alt="Jojo Juice" class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="font-extrabold text-xl text-slate-900">Jojo Juice - Part time</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Pontianak, Jalan Merdeka No 23 | PT Lingga Jaya Utama</p>
                    <div class="mt-3 text-xs text-slate-700 space-y-1 font-semibold">
                        <p>Mencari : <span class="font-normal text-gray-600">Pelayan</span></p>
                        <p>Minimal Lulusan : <span class="font-normal text-gray-600">SMA/SMK</span></p>
                        <p>Maximal Umur : <span class="font-normal text-gray-600">24</span></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <div class="w-56">
                    <div class="flex justify-between text-xs font-bold mb-1.5">
                        <span class="text-slate-800">Pelamar saat ini : 4</span>
                        <span class="text-gray-400">4/10</span>
                    </div>
                    <div class="w-full bg-amber-100 rounded-full h-3">
                        <div class="bg-amber-500 h-3 rounded-full" style="width: 40%"></div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('job.detail') }}" class="bg-slate-950 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-slate-800 transition">View</a>
                    <button type="button" class="bg-red-600 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-red-700 transition">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- FULL TIME SECTION --}}
    <h2 class="text-2xl font-bold text-slate-900 mb-4">Full Time</h2>
    
    <div class="space-y-4">
        {{-- Card 4: YSL --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="flex items-center space-x-5">
                <div class="w-24 h-24 bg-white border border-gray-200 rounded-2xl flex items-center justify-center p-2 flex-shrink-0">
                    <img src="{{ asset('images/ysl.png') }}" alt="YSL" class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="font-extrabold text-xl text-slate-900">YSL</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Pontianak, Jalan Merdeka No 23 | PT Lingga Jaya Utama</p>
                    <div class="mt-3 text-xs text-slate-700 space-y-1 font-semibold">
                        <p>Mencari : <span class="font-normal text-gray-600">Pelayan</span></p>
                        <p>Minimal Lulusan : <span class="font-normal text-gray-600">SMA/SMK</span></p>
                        <p>Maximal Umur : <span class="font-normal text-gray-600">24</span></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <div class="w-56">
                    <div class="flex justify-between text-xs font-bold mb-1.5">
                        <span class="text-slate-800">Pelamar saat ini : 7</span>
                        <span class="text-gray-400">7/10</span>
                    </div>
                    <div class="w-full bg-amber-100 rounded-full h-3">
                        <div class="bg-amber-500 h-3 rounded-full" style="width: 70%"></div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('job.detail') }}" class="bg-slate-950 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-slate-800 transition">View</a>
                    <button type="button" class="bg-red-600 text-white px-7 py-2 rounded-xl text-sm font-semibold hover:bg-red-700 transition">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection