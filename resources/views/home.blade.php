<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nemu Kerja!</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-white text-[#151442]">

    {{-- NAVBAR --}}
    @include('component.navbar')

    <!-- =====================================================
         HERO
    ===================================================== -->

    <section class="
        overflow-hidden
        border-b border-gray-200
    ">

        <div class="
            mx-auto grid
            max-w-[1500px]
            grid-cols-1
            items-center
            gap-10
            px-6
            py-14
            lg:grid-cols-2
            lg:px-10
        ">

            <div>
                <p class="
                    mb-3
                    text-xs font-bold
                    tracking-[3px]
                    text-gray-500
                ">
                    TEMUKAN PEKERJAAN TERBAIK
                </p>

                <h1 class="
                    text-5xl
                    font-extrabold
                    leading-[1.05]
                    tracking-tight
                    lg:text-6xl
                ">
                    Stop Jobless.
                    <br>
                    Temukan Karir
                    <span class="text-[#ef9d00]">
                        Impianmu!
                    </span>
                </h1>

                <p class="
                    mt-6
                    max-w-xl
                    text-base
                    leading-relaxed
                    text-[#35335c]
                    lg:text-lg
                ">
                    Ribuan lowongan kerja siap menantimu.
                    Nemu Kerja! membantu kamu seperti
                    pahlawan super.
                </p>

                <form
                    id="searchForm"
                    class="
                        mt-7
                        flex max-w-xl
                        items-center
                        rounded-full
                        border border-gray-200
                        bg-white
                        p-1
                        shadow-lg
                    "
                >
                    <div class="
                        flex flex-1
                        items-center gap-2
                        px-3
                    ">
                        <span class="text-gray-400">⌕</span>
                        <input
                            id="keyword"
                            type="text"
                            placeholder="Kata Kunci Pekerjaan"
                            class="
                                w-full
                                bg-transparent
                                text-sm
                                outline-none
                            "
                        >
                    </div>

                    <div class="
                        h-7
                        border-l
                        border-gray-300
                    "></div>

                    <div class="
                        flex flex-1
                        items-center gap-2
                        px-3
                    ">
                        <span class="text-gray-400">⌖</span>
                        <input
                            id="location"
                            type="text"
                            placeholder="Lokasi Pekerjaan"
                            class="
                                w-full
                                bg-transparent
                                text-sm
                                outline-none
                            "
                        >
                    </div>

                    <button
                        type="submit"
                        class="
                            rounded-full
                            bg-[#151442]
                            px-7 py-3
                            text-sm
                            font-semibold
                            text-white
                        "
                    >
                        Cari
                    </button>
                </form>

                <div class="mt-12">
                    <h2 class="
                        mb-5
                        text-xl
                        font-bold
                    ">
                        Kategori Pekerjaan Populer
                    </h2>

                    <div class="
                        grid
                        grid-cols-2
                        gap-4
                        sm:grid-cols-4
                    ">
                        @foreach($categories as $category)
                            <button
                                type="button"
                                class="
                                    category-btn
                                    flex h-28
                                    flex-col
                                    items-center
                                    justify-center
                                    gap-3
                                    rounded-xl
                                    bg-white
                                    shadow-lg
                                    transition
                                    hover:-translate-y-1
                                "
                                data-category="{{ $category['name'] }}"
                            >
                                <img
                                    src="{{ asset('images/' . $category['icon']) }}"
                                    alt="{{ $category['name'] }}"
                                    class="h-10 w-10 object-contain"
                                >
                                <span class="text-xs">{{ $category['name'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="
                relative
                hidden
                h-[540px]
                lg:block
            ">
                <div class="
                    absolute left-10 top-20
                    h-60 w-44
                    rotate-[-7deg]
                    bg-[#19b8e8]
                    p-5
                    text-white
                    shadow-xl
                ">
                    <p class="text-xl font-extrabold">Dokumentasi</p>
                    <p class="text-xl font-extrabold">Webinar</p>
                    <div class="
                        mt-10
                        h-20
                        rounded
                        bg-white/30
                    "></div>
                </div>

                <div class="
                    absolute right-0 top-24
                    h-60 w-48
                    rotate-[7deg]
                    bg-[#216fe5]
                    p-5
                    text-white
                    shadow-xl
                ">
                    <p class="text-lg font-extrabold">Webinar Navigation</p>
                    <p class="mt-2 text-sm">Future Development</p>
                </div>

                <div class="
                    absolute bottom-0 left-1/2
                    h-[440px] w-[300px]
                    -translate-x-1/2
                ">
                    <div class="
                        absolute left-20 top-0
                        h-24 w-40
                        rounded-t-full
                        bg-gray-100
                        shadow-lg
                    "></div>
                    <div class="
                        absolute left-[90px] top-16
                        h-36 w-28
                        rounded-[50%]
                        bg-[#b97850]
                    "></div>
                    <div class="
                        absolute left-10 top-48
                        h-64 w-56
                        rounded-t-[60px]
                        bg-[#a94f25]
                    "></div>
                    <div class="
                        absolute left-7 top-60
                        h-32 w-64
                        rounded-lg
                        border-8 border-gray-500
                        bg-gray-300
                        shadow-xl
                    ">
                        <div class="
                            absolute inset-3
                            bg-gray-100
                        "></div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- =====================================================
         JOBS
    ===================================================== -->

    <section
        id="lowongan"
        class="
            mx-auto
            max-w-[1500px]
            px-6
            py-14
            lg:px-10
        "
    >

        <div class="
            mb-8
            flex items-center
            justify-between
        ">

            <h2 class="
                text-2xl
                font-bold
                lg:text-3xl
            ">
                Cari Pekerjaanmu Sekarang!
            </h2>

            <button
                id="filterButton"
                class="
                    flex items-center
                    gap-2
                    font-semibold
                "
            >
                Filter

                <span class="text-xl">
                    ☰
                </span>

            </button>

        </div>

        <div
            id="filterPanel"
            class="
                mb-8
                hidden flex-wrap
                gap-2
            "
        >
            <button
                class="
                    filter-btn active
                    rounded-full
                    bg-[#151442]
                    px-5 py-2
                    text-sm
                    text-white
                "
                data-filter="all"
            >
                Semua
            </button>

            @foreach([
                'Pelayanan',
                'Design UI/UX',
                'Data Analytic',
                'Teknik',
                'Operasional'
            ] as $filter)
                <button
                    class="
                        filter-btn
                        rounded-full
                        border border-gray-300
                        px-5 py-2
                        text-sm
                    "
                    data-filter="{{ $filter }}"
                >
                    {{ $filter }}
                </button>
            @endforeach
        </div>

        <div
            id="jobGrid"
            class="
                grid
                grid-cols-1
                gap-8
                sm:grid-cols-2
                lg:grid-cols-4
            "
        >
            @foreach($jobs as $job)
                <article
                    class="
                        job-card
                        overflow-hidden
                        rounded-xl
                        border
                        border-gray-100
                        bg-white
                        shadow-lg
                        transition
                        hover:-translate-y-1
                        hover:shadow-xl
                    "
                    data-category="{{ $job['category'] }}"
                    data-search="{{ strtolower(
                        $job['company'] . ' ' .
                        $job['position'] . ' ' .
                        $job['location'] . ' ' .
                        $job['education']
                    ) }}"
                >
                    <div class="
                        flex h-48
                        items-center
                        justify-center
                        bg-white
                        text-center
                    ">
                        @if($job['company'] === "Hotway's - Part time")
                            <div class="
                                flex h-full w-full
                                items-center
                                justify-center
                                bg-red-600
                            ">
                                <span class="
                                    text-3xl
                                    font-black
                                    text-white
                                ">
                                    HOTWAY'S
                                </span>
                            </div>
                        @elseif($job['company'] === 'Ayam Budi')
                            <div class="
                                flex h-full w-full
                                items-center
                                justify-center
                                bg-red-500
                            ">
                                <span class="
                                    text-2xl
                                    font-black
                                    text-white
                                ">
                                    AYAM BUDI
                                </span>
                            </div>
                        @elseif($job['company'] === "McDonald's Pontianak")
                            <div class="
                                flex flex-col
                                items-center
                            ">
                                <div class="
                                    flex h-24 w-24
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-red-600
                                ">
                                    <span class="
                                        text-6xl
                                        font-black
                                        text-yellow-400
                                    ">
                                        M
                                    </span>
                                </div>
                                <span class="
                                    mt-3
                                    text-xl
                                    font-bold
                                    text-black
                                ">
                                    McDonald's
                                </span>
                            </div>
                        @elseif($job['company'] === 'BCA Jakarta Pusat')
                            <span class="
                                text-6xl
                                font-black
                                text-blue-700
                            ">
                                BCA
                            </span>
                        @elseif($job['company'] === 'Pertamina Sur Jaw')
                            <span class="
                                text-3xl
                                font-black
                            ">
                                PERTAMINA
                            </span>
                        @elseif($job['company'] === 'Teazzi Ptk - Part time')
                            <span class="
                                font-serif
                                text-5xl
                                text-gray-900
                            ">
                                teazzi
                            </span>
                        @else
                            <span class="
                                text-4xl
                                font-black
                                {{ $job['logoClass'] }}
                            ">
                                {{ $job['logo'] }}
                            </span>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="
                            mb-3
                            text-sm
                            font-extrabold
                        ">
                            {{ $job['company'] }}
                        </h3>

                        <p class="text-xs leading-5">
                            Mencari :
                            {{ $job['position'] }}
                        </p>

                        <p class="text-xs leading-5">
                            Minimal Lulusan :
                            {{ $job['education'] }}
                        </p>

                        <p class="text-xs leading-5">
                            Maksimal Umur :
                            {{ $job['age'] }}
                        </p>

                        <p class="
                            mt-3
                            text-right
                            text-[10px]
                            text-gray-500
                        ">
                            {{ $job['needed'] }}
                            orang di butuhkan
                        </p>
                    </div>
                </article>
            @endforeach
        </div>

        <div
            id="empty"
            class="
                hidden
                py-20
                text-center
            "
        >
            <h3 class="
                text-xl
                font-bold
            ">
                Lowongan tidak ditemukan
            </h3>

            <p class="
                mt-2
                text-sm
                text-gray-500
            ">
                Coba kata kunci atau kategori lain.
            </p>
        </div>

        <div class="
            mt-12
            flex items-center
            gap-5
        ">
            <div class="
                h-px flex-1
                bg-gray-300
            "></div>

            <button class="
                text-sm
                text-[#151442]
            ">
                see more
            </button>

            <div class="
                h-px flex-1
                bg-gray-300
            "></div>
        </div>
    </section>

    <footer
        id="perusahaan"
        class="
            relative
            bg-[#151442]
            text-white
        "
    >
        <div class="
            mx-auto grid
            max-w-[1300px]
            grid-cols-1
            gap-10
            px-8
            py-16
            sm:grid-cols-2
            lg:grid-cols-4
        ">
            <div>
                <h2 class="
                    text-4xl
                    font-black
                    leading-[.8]
                ">
                    Nemu<br>
                    Kerja<span class="text-[#ef9d00]">!</span>
                </h2>

                <p class="
                    mt-8
                    text-xs
                    text-gray-300
                ">
                    “Solusi cepat temukan pekerjaan paling tepat.”
                </p>
            </div>

            <div>
                <h3 class="
                    mb-5
                    font-bold
                ">
                    Navigasi Cepat
                </h3>

                <a href="{{ route('home') }}" class="mb-2 block text-sm text-gray-300 hover:text-white">
                    Home
                </a>
                <a href="#lowongan" class="mb-2 block text-sm text-gray-300 hover:text-white">
                    Lowongan
                </a>
                <a href="#perusahaan" class="mb-2 block text-sm text-gray-300 hover:text-white">
                    Perusahaan
                </a>
                <a href="#tips" class="mb-2 block text-sm text-gray-300 hover:text-white">
                    Tips Karir
                </a>
            </div>

            <div>
                <h3 class="
                    mb-5
                    font-bold
                ">
                    Perusahaan
                </h3>

                <a href="#" class="mb-2 block text-sm text-gray-300 hover:text-white">
                    NemuKerja
                </a>
                <a href="#" class="mb-2 block text-sm text-gray-300 hover:text-white">
                    NemuKerja Digital
                </a>
            </div>

            <div>
                <h3 class="
                    mb-5
                    font-bold
                ">
                    Sosial Media
                </h3>

                <div class="flex gap-3">
                    <a href="#" class="
                        flex h-8 w-8
                        items-center
                        justify-center
                        rounded-lg
                        border
                        border-white
                    ">◎</a>
                    <a href="#" class="
                        flex h-8 w-8
                        items-center
                        justify-center
                        rounded-lg
                        border
                        border-white
                    ">f</a>
                    <a href="#" class="
                        flex h-8 w-8
                        items-center
                        justify-center
                        rounded-lg
                        border
                        border-white
                    ">◔</a>
                    <a href="#" class="
                        flex h-8 w-8
                        items-center
                        justify-center
                        rounded-lg
                        border
                        border-white
                    ">@</a>
                </div>
            </div>
        </div>

        <div class="
            flex h-8
            items-center
            justify-center
            bg-[#ef9d00]
            text-[10px]
            font-semibold
            text-white
        ">
            © {{ date('Y') }} NemuKerja. All Rights Reserved.
        </div>
    </footer>

</body>

</html>