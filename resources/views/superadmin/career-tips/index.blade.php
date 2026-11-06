@extends('layouts.superadmin')

@section('title', 'Daftar Tips Karier')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">Daftar Tips Karier</h1>
            <p class="mt-2 text-sm text-gray-500">Tulis, edit, dan terbitkan tips untuk halaman publik.</p>
        </div>
        <a href="{{ route('superadmin.career-tips.create') }}" class="rounded-full bg-[#151442] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#25236b]">+ Tambah Tips</a>
    </div>

    <div class="mt-7 space-y-4">
        @forelse ($careerTips as $careerTip)
            <article class="flex flex-col gap-5 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:p-5">
                @if ($careerTip->image_path)
                    <img src="{{ $careerTip->image_url }}" alt="" class="h-24 w-32 shrink-0 rounded-xl object-cover">
                @else
                    <div class="flex h-24 w-32 shrink-0 items-center justify-center rounded-xl bg-[#f8e8bf] text-2xl font-black text-[#151442]">Tips</div>
                @endif
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-lg font-extrabold">{{ $careerTip->title }}</h2>
                        <span @class([
                            'rounded-full px-3 py-1 text-[10px] font-semibold',
                            'bg-green-50 text-green-700' => $careerTip->status === 'published',
                            'bg-gray-100 text-gray-600' => $careerTip->status !== 'published',
                        ])>{{ $careerTip->status === 'published' ? 'Terbit' : 'Draft' }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">{{ $careerTip->source ?: 'Nemu Kerja!' }} · {{ $careerTip->published_at?->format('d M Y') ?: 'Belum diterbitkan' }}</p>
                    <p class="mt-2 line-clamp-2 text-sm text-gray-600">{{ $careerTip->summary }}</p>
                </div>
                <div class="flex shrink-0 gap-2">
                    <a href="{{ route('superadmin.career-tips.edit', $careerTip) }}" class="rounded-full border border-[#151442] px-4 py-2 text-xs font-semibold hover:bg-[#151442] hover:text-white">Edit</a>
                    <form action="{{ route('superadmin.career-tips.destroy', $careerTip) }}" method="POST" onsubmit="return confirm('Arsipkan tips ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="rounded-2xl bg-white px-6 py-16 text-center text-sm text-gray-500">Belum ada tips karier.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $careerTips->links() }}</div>
@endsection
