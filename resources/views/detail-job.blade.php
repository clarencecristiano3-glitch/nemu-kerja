<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job['title'] }} - Nemu Kerja!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-[#151442] antialiased">
    @include('layouts.navbar')

    <main class="mx-auto max-w-[1360px] px-5 py-10 lg:px-14 lg:py-12">
        <section
            class="grid items-center overflow-hidden rounded-[22px] bg-white shadow-[0_4px_16px_rgba(0,0,0,0.16)] lg:grid-cols-[178px_1fr_170px]">
            <div @class([
                'flex h-44 items-center justify-center p-4 lg:h-44',
                'bg-[#ed0015]' => $job['logoBackground'],
                'bg-white' => ! $job['logoBackground'],
            ])>
                @if ($job['image'])
                    <img src="{{ $job['image'] }}" alt="Logo {{ $job['brand'] }}"
                        class="h-full w-full object-contain">
                @else
                    <span class="text-center text-3xl font-black {{ $job['logoClass'] }}">{{ $job['logo'] }}</span>
                @endif
            </div>
            <div class="px-6 py-6 lg:px-7">
                <h1 class="text-2xl font-extrabold leading-tight tracking-tight lg:text-[25px]">{{ $job['title'] }}</h1>
                <p class="mt-1 text-xs text-[#777595]">{{ $job['company_location'] }} | {{ $job['company_pt'] }}</p>
                <div class="mt-3 grid gap-1 text-[11px] leading-snug text-[#151442] sm:grid-cols-2">
                    <p>Mencari: {{ $job['position'] }}</p>
                    <p>Minimal Lulusan: {{ $job['education'] }}</p>
                    <p>Maksimal Umur: {{ $job['age'] }}</p>
                </div>
                <div class="mt-4 max-w-[420px]">
                    <div class="h-3 overflow-hidden rounded-full bg-[#f8e8bf]">
                        <div class="h-full rounded-full bg-[#ed9d00]"
                            style="width: {{ min(100, (int) round($job['applicants'] / $job['quota'] * 100)) }}%"></div>
                    </div>
                    <div class="mt-1 flex justify-between text-[9px] text-[#777595]">
                        <span class="font-semibold text-[#151442]">Pelamar saat ini: {{ $job['applicants'] }}</span>
                        <span>{{ $job['applicants'] }}/{{ $job['quota'] }}</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-100 px-6 py-5 text-center lg:border-l lg:border-t-0">
                <p class="text-xs font-bold">Waktu Tersisa</p>
                <p class="mt-1 text-6xl font-black leading-none tracking-tight">
                    {{ str_pad($job['remaining_days'], 2, '0', STR_PAD_LEFT) }}</p>
                <p class="mt-1 text-[10px] tracking-[7px]">Hari</p>
            </div>
        </section>

        <section class="mt-6 grid gap-4 md:grid-cols-2">
            <article class="min-h-[158px] rounded-xl border border-gray-200 bg-white px-7 py-5 shadow-sm md:col-span-2">
                <h2 class="text-base font-extrabold">Tentang Pekerjaan</h2>
                <p class="mt-3 whitespace-pre-line text-[10px] leading-relaxed text-[#35335c]">{{ $job['description'] }}</p>
            </article>
            @foreach ([
                'Tanggung Jawab' => $job['responsibilities'],
                'Kualifikasi' => $job['qualifications'],
                'Jadwal Kerja' => $job['schedule'],
                'Gaji & Benefit' => $job['benefits'],
            ] as $heading => $items)
                <article class="min-h-[158px] rounded-xl border border-gray-200 bg-white px-7 py-5 shadow-sm">
                    <h2 class="text-base font-extrabold">{{ $heading }}</h2>
                    <ul class="mt-3 list-disc space-y-1 pl-3 text-[10px] leading-snug text-[#35335c] marker:text-[#151442]">
                        @foreach ($items as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </section>

        <a href="{{ route('job.apply', ['jobId' => $job['id']]) }}"
            class="mt-9 block rounded-full bg-[#ed9d00] py-3 text-center text-sm font-bold text-white shadow-sm hover:bg-[#d88d00]">Lamar
            Sekarang!</a>
    </main>

    @include('partials.footer')
</body>

</html>