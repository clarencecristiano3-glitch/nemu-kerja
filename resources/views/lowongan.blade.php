<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#191950">
    <title>Lowongan Kerja - Nemu Kerja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-[#151442] antialiased [font-family:Poppins,sans-serif]">
    @include('layouts.navbar')

    <main>
        <section class="mx-auto max-w-[1500px] px-2 pt-8 pb-4 sm:px-4 lg:px-6">
            <div class="mx-auto grid max-w-5xl items-center gap-4 md:grid-cols-2 md:gap-6">
                <div class="order-2 flex justify-center md:order-1">
                    <img src="{{ asset('images/tom.png') }}" alt="Temukan pekerjaan impianmu"
                        class="h-56 w-full max-w-[500px] object-contain md:h-[500px]">
                </div>

                <div class="order-1 flex flex-col items-right text-right md:order-2">
                    <h1 class="text-10xl font-extrabold leading-[1.08] tracking-tight text-[#08083f] sm:text-5xl lg:text-10xl">
                        Cari Pekerjaan<br>
                        Mu <span class="text-[#ef9d00]">Sekarang!</span>
                    </h1>
                    <p class="mt-4 max-w-xl text-sm leading-relaxed text-[#35335c]">
                        Ribuan lowongan kerja siap menantimu. Nemu Kerja! membantu kamu seperti pahlawan super.
                    </p>

                    <form id="searchForm"
                        class="mt-5 flex w-full max-w-xl items-center rounded-full border border-gray-200 bg-white p-1 shadow-lg">
                        <div class="flex flex-1 items-center gap-2 px-3">
                            <span class="text-gray-400">⌕</span>
                            <input id="keyword" type="text" placeholder="Kata Kunci Pekerjaan"
                                class="w-full bg-transparent text-sm outline-none">
                        </div>

                        <div class="h-7 border-l border-gray-300"></div>

                        <div class="flex flex-1 items-center gap-2 px-3">
                            <span class="text-gray-400">⌖</span>
                            <input id="location" type="text" placeholder="Lokasi Pekerjaan"
                                class="w-full bg-transparent text-sm outline-none">
                        </div>

                        <button type="submit" class="rounded-full bg-[#151442] px-7 py-3 text-sm font-semibold text-white">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-[1500px] px-6 pt-4 pb-10 lg:px-10">
            <div class="mb-5 flex items-center justify-between gap-4">
                <h2 class="text-xl font-bold sm:text-2xl">Daftar Lowongan</h2>
                <button id="filterButton" type="button" aria-expanded="false" aria-controls="filterPanel"
                    class="flex shrink-0 items-center gap-2 text-sm font-semibold hover:text-[#ef9d00]">
                    Filter
                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round">
                        <path d="M4 6h16M7 12h10m-7 6h4" />
                    </svg>
                </button>
            </div>

            <div id="filterPanel" class="mb-5 hidden flex-wrap gap-2">
                <button type="button" data-filter="all"
                    class="filter-button rounded-full bg-[#151442] px-4 py-2 text-xs font-medium text-white">Semua</button>
                @foreach (['Pelayanan', 'Design UI/UX', 'Data Analytic', 'Teknik', 'Operasional'] as $category)
                    <button type="button" data-filter="{{ $category }}"
                        class="filter-button rounded-full border border-gray-300 px-4 py-2 text-xs font-medium hover:border-[#151442]">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <div id="jobGrid" class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($jobs as $job)
                    <article
                        class="job-card overflow-hidden rounded-xl border border-gray-100 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.16)] transition hover:-translate-y-1 hover:shadow-lg"
                        data-category="{{ $job['category'] }}"
                        data-search="{{ mb_strtolower($job['company'] . ' ' . $job['position'] . ' ' . $job['location'] . ' ' . $job['education']) }}">
                        <div class="flex h-28 items-center justify-center overflow-hidden border-b border-gray-100 bg-white sm:h-32">
                            @if ($job['image'])
                                <img src="{{ asset('images/' . $job['image']) }}" alt="Logo {{ $job['company'] }}"
                                    class="h-full w-full object-contain">
                            @elseif ($job['company'] === "Hotway's - Part time")
                                <div class="flex h-full w-full items-center justify-center bg-[#ed0015] px-2 text-center text-lg font-black text-white sm:text-2xl">
                                    HOTWAY'S
                                </div>
                            @elseif ($job['company'] === 'Pertamina Sur Jaw')
                                <span class="text-center text-lg font-black text-[#111] sm:text-2xl">PERTAMINA</span>
                            @else
                                <span class="text-center text-2xl font-black {{ $job['logoClass'] }} sm:text-4xl">{{ $job['logo'] }}</span>
                            @endif
                        </div>
                        <div class="flex min-h-[104px] flex-col p-3 sm:p-4">
                            <h3 class="mb-2 text-xs font-extrabold leading-snug sm:text-sm">{{ $job['company'] }}</h3>
                            <p class="text-[10px] leading-relaxed sm:text-[11px]">Mencari: {{ $job['position'] }}</p>
                            <p class="text-[10px] leading-relaxed sm:text-[11px]">Minimal Lulusan: {{ $job['education'] }}</p>
                            <p class="text-[10px] leading-relaxed sm:text-[11px]">Maksimal Umur: {{ $job['age'] }}</p>
                            <p class="mt-auto pt-2 text-right text-[8px] text-gray-400">{{ $job['needed'] }} orang dibutuhkan</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div id="emptyJobs" @class([
                'py-16 text-center',
                'hidden' => count($jobs) > 0,
            ])>
                <h3 class="text-lg font-bold">Lowongan tidak ditemukan</h3>
                <p class="mt-2 text-sm text-gray-500">Coba kata kunci, lokasi, atau kategori lain.</p>
            </div>

            <div class="mt-12 flex items-center gap-5 text-sm text-[#151442]">
                <span class="h-px flex-1 bg-gray-300"></span>
                <span>see more</span>
                <span class="h-px flex-1 bg-gray-300"></span>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <script>
        (() => {
            const filterButton = document.getElementById('filterButton');
            const filterPanel = document.getElementById('filterPanel');
            const jobCards = Array.from(document.querySelectorAll('.job-card'));
            const emptyJobs = document.getElementById('emptyJobs');
            let activeCategory = 'all';

            filterButton?.addEventListener('click', () => {
                const isExpanded = filterButton.getAttribute('aria-expanded') === 'true';
                filterButton.setAttribute('aria-expanded', String(!isExpanded));
                filterPanel?.classList.toggle('hidden', isExpanded);
            });

            document.querySelectorAll('.filter-button').forEach((button) => {
                button.addEventListener('click', () => {
                    activeCategory = button.dataset.filter ?? 'all';

                    document.querySelectorAll('.filter-button').forEach((filterButton) => {
                        const isActive = filterButton === button;
                        filterButton.classList.toggle('bg-[#151442]', isActive);
                        filterButton.classList.toggle('text-white', isActive);
                    });

                    let visibleJobs = 0;
                    jobCards.forEach((card) => {
                        const isVisible = activeCategory === 'all' || card.dataset.category === activeCategory;
                        card.classList.toggle('hidden', !isVisible);
                        visibleJobs += Number(isVisible);
                    });
                    emptyJobs?.classList.toggle('hidden', visibleJobs > 0);
                });
            });
        })();
    </script>
</body>

</html>