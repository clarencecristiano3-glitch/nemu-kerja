@extends('layouts.app')

@section('title', 'Tips Karier - Nemu Kerja!')

@section('content')
    <main class="mx-auto max-w-[1500px] px-5 py-10 lg:px-10">
        <div class="max-w-2xl">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#ef9d00]">Panduan Karier</p>
            <h1 class="mt-2 text-4xl font-extrabold tracking-tight">Tips Karier</h1>
            <p class="mt-3 text-sm leading-relaxed text-gray-600">Bacaan praktis untuk membantu perjalanan karier dan pencarian kerja.</p>
        </div>

        <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($careerTips as $careerTip)
                <article class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                    @if ($careerTip->image_path)
                        <img src="{{ $careerTip->image_url }}" alt="" class="h-48 w-full object-cover">
                    @else
                        <div class="flex h-48 items-center justify-center bg-[#f8e8bf] text-3xl font-black text-[#151442]">Tips Karier</div>
                    @endif
                    <div class="p-5">
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-[#ef9d00]">{{ $careerTip->source ?: 'Nemu Kerja!' }} · {{ $careerTip->published_at?->format('d M Y') }}</p>
                        <h2 class="mt-2 text-xl font-extrabold">{{ $careerTip->title }}</h2>
                        <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $careerTip->summary }}</p>
                        <div class="mt-4 whitespace-pre-line text-sm leading-relaxed text-[#35335c]">{{ $careerTip->body }}</div>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-gray-100 bg-white px-6 py-16 text-center text-sm text-gray-500 md:col-span-2 xl:col-span-3">
                    Belum ada tips karier yang diterbitkan.
                </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $careerTips->links() }}</div>
    </main>
@endsection
