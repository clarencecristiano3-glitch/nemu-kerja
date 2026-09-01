<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Nemu Kerja!
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-white text-[#151442]">


<header class="sticky top-0 z-50 border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-[1500px] items-center justify-between px-6 py-4 lg:px-10">

        <!-- LOGO (logonya.png) -->
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-10 w-auto">
        </a>

        <!-- NAVIGATION -->
        <nav class="hidden items-center gap-12 lg:flex">
            <a href="#" class="font-bold text-[#151442]">Beranda</a>
            <a href="#lowongan" class="text-gray-600 hover:text-[#151442]">Lowongan</a>
            <a href="#perusahaan" class="text-gray-600 hover:text-[#151442]">Perusahaan</a>
            <a href="#tips" class="text-gray-600 hover:text-[#151442]">Tips Karir</a>
        </nav>

        <!-- BUTTONS & PANDA ICON -->
        <div class="flex items-center gap-3">
            <a href="#" class="rounded-full border border-[#151442] px-6 py-1.5 text-sm font-semibold text-[#151442]">
                Masuk
            </a>
            <a href="#" class="rounded-full bg-[#151442] px-6 py-1.5 text-sm font-semibold text-white">
                Daftar
            </a>
            
            <!-- GAMBAR PANDA PALING KANAN -->
            <a href="#" class="ml-1 flex items-center">
                <img src="{{ asset('images/pandanya.png') }}" alt="Panda Profile" class="h-9 w-auto object-contain">
            </a>
        </div>

    </div>
</header>



<!-- =====================================================
     HERO
===================================================== -->

<section
    class="
        overflow-hidden
        border-b border-gray-200
    "
>

    <div
        class="
            mx-auto grid
            max-w-[1500px]
            grid-cols-1
            items-center
            gap-10
            px-6
            py-14
            lg:grid-cols-2
            lg:px-10
        "
    >

        <!-- LEFT -->

        <div>

            <p
                class="
                    mb-3
                    text-xs font-bold
                    tracking-[3px]
                    text-gray-500
                "
            >
                TEMUKAN PEKERJAAN TERBAIK
            </p>


            <h1
                class="
                    text-5xl
                    font-extrabold
                    leading-[1.05]
                    tracking-tight
                    lg:text-6xl
                "
            >

                Stop Jobless.
                <br>

                Temukan Karir
                <span class="text-[#ef9d00]">
                    Impianmu!
                </span>

            </h1>


            <p
                class="
                    mt-6
                    max-w-xl
                    text-base
                    leading-relaxed
                    text-[#35335c]
                    lg:text-lg
                "
            >

                Ribuan lowongan kerja siap menantimu.
                Nemu Kerja! membantu kamu seperti
                pahlawan super.

            </p>


            <!-- SEARCH -->

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

                <div
                    class="
                        flex flex-1
                        items-center gap-2
                        px-3
                    "
                >

                    <span class="text-gray-400">
                        ⌕
                    </span>

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


                <div
                    class="
                        h-7
                        border-l
                        border-gray-300
                    "
                ></div>


                <div
                    class="
                        flex flex-1
                        items-center gap-2
                        px-3
                    "
                >

                    <span class="text-gray-400">
                        ⌖
                    </span>

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


            <!-- CATEGORY -->

            <div class="mt-12">

                <h2
                    class="
                        mb-5
                        text-xl
                        font-bold
                    "
                >
                    Kategori Pekerjaan Populer
                </h2>


                <div
                    class="
                        grid
                        grid-cols-2
                        gap-4
                        sm:grid-cols-4
                    "
                >

                    @foreach($categories as $category)
    <button
        type="button"
        class="category-btn flex h-28 flex-col items-center justify-center gap-3 rounded-xl bg-white shadow-lg transition hover:-translate-y-1"
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



        <!-- RIGHT HERO -->
<div class="relative hidden h-full w-full items-center justify-center lg:flex">
    <img 
        src="{{ asset('images/Group 163.png') }}" 
        alt="Hero Image" 
        class="h-auto max-h-[1000px] w-full max-w-[1000px] object-contain"
    >
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

    <!-- HEADER -->

    <div
        class="
            mb-8
            flex items-center
            justify-between
        "
    >

        <h2
            class="
                text-2xl
                font-bold
                lg:text-3xl
            "
        >
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


    <!-- FILTER -->

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



    <!-- CARDS -->

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
                    $job['company'].' '.
                    $job['position'].' '.
                    $job['location'].' '.
                    $job['education']
                ) }}"
            >

                <!-- LOGO -->

                <div
                    class="
                        flex h-48
                        items-center
                        justify-center
                        bg-white
                        text-center
                    "
                >

                    @if($job['company'] === "Hotway's - Part time")

                        <div
                            class="
                                flex h-full w-full
                                items-center
                                justify-center
                                bg-red-600
                            "
                        >

                            <span
                                class="
                                    text-3xl
                                    font-black
                                    text-white
                                "
                            >
                                HOTWAY'S
                            </span>

                        </div>

                    @elseif($job['company'] === 'Ayam Budi')

                        <div
                            class="
                                flex h-full w-full
                                items-center
                                justify-center
                                bg-red-500
                            "
                        >

                            <span
                                class="
                                    text-2xl
                                    font-black
                                    text-white
                                "
                            >
                                AYAM BUDI
                            </span>

                        </div>

                    @elseif($job['company'] === "McDonald's Pontianak")

                        <div
                            class="
                                flex flex-col
                                items-center
                            "
                        >

                            <div
                                class="
                                    flex h-24 w-24
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-red-600
                                "
                            >

                                <span
                                    class="
                                        text-6xl
                                        font-black
                                        text-yellow-400
                                    "
                                >
                                    M
                                </span>

                            </div>

                            <span
                                class="
                                    mt-3
                                    text-xl
                                    font-bold
                                    text-black
                                "
                            >
                                McDonald's
                            </span>

                        </div>

                    @elseif($job['company'] === 'BCA Jakarta Pusat')

                        <span
                            class="
                                text-6xl
                                font-black
                                text-blue-700
                            "
                        >
                            BCA
                        </span>

                    @elseif($job['company'] === 'Pertamina Sur Jaw')

                        <span
                            class="
                                text-3xl
                                font-black
                            "
                        >
                            PERTAMINA
                        </span>

                    @elseif($job['company'] === 'Teazzi Ptk - Part time')

                        <span
                            class="
                                font-serif
                                text-5xl
                                text-gray-900
                            "
                        >
                            teazzi
                        </span>

                    @else

                        <span
                            class="
                                text-4xl
                                font-black
                                {{ $job['logoClass'] }}
                            "
                        >
                            {{ $job['logo'] }}
                        </span>

                    @endif

                </div>


                <!-- CONTENT -->

                <div class="p-4">

                    <h3
                        class="
                            mb-3
                            text-sm
                            font-extrabold
                        "
                    >
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


                    <p
                        class="
                            mt-3
                            text-right
                            text-[10px]
                            text-gray-500
                        "
                    >
                        {{ $job['needed'] }}
                        orang di butuhkan
                    </p>

                </div>

            </article>

        @endforeach

    </div>


    <!-- EMPTY -->

    <div
        id="empty"
        class="
            hidden
            py-20
            text-center
        "
    >

        <h3
            class="
                text-xl
                font-bold
            "
        >
            Lowongan tidak ditemukan
        </h3>

        <p
            class="
                mt-2
                text-sm
                text-gray-500
            "
        >
            Coba kata kunci atau kategori lain.
        </p>

    </div>


    <!-- SEE MORE -->

    <div
        class="
            mt-12
            flex items-center
            gap-5
        "
    >

        <div
            class="
                h-px flex-1
                bg-gray-300
            "
        ></div>


        <button
            class="
                text-sm
                text-[#151442]
            "
        >
            see more
        </button>


        <div
            class="
                h-px flex-1
                bg-gray-300
            "
        ></div>

    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<!-- FOOTER -->
<footer id="perusahaan" class="relative bg-[#151442] text-white">

    <!-- PANDA MASCOT (Paling Kanan Atas Footer) -->
    <div class="absolute -top-13 right-4 lg:right-8 z-10">
        <img 
            src="{{ asset('images/Panda.png') }}" 
            alt="Panda Mascot" 
            class="h-14 w-auto object-contain lg:h-16"
        >
    </div>

    <!-- GRID 4 KOLOM -->
    <div class="mx-auto grid max-w-[1300px] grid-cols-1 gap-10 px-8 py-16 sm:grid-cols-2 lg:grid-cols-4">

        <!-- KOLOM 1: LOGO PUTIH & SLOGAN -->
        <div>
    <a href="{{ route('home') }}" class="inline-block mt-3 lg:mt-4">
        <img 
            src="{{ asset('images/logo putih.png') }}" 
            alt="Nemu Kerja!" 
            class="h-16 w-auto object-contain lg:h-20"
        >
    </a>
    <p class="mt-4 text-xs text-gray-300">
        “Solusi cepat temukan pekerjaan paling tepat.”
    </p>
</div>

        <!-- KOLOM 2: NAVIGASI CEPAT -->
        <div>
            <h3 class="mb-5 font-bold">Navigasi Cepat</h3>
            <a href="#" class="mb-2 block text-sm text-gray-300 hover:text-white">Home</a>
            <a href="#lowongan" class="mb-2 block text-sm text-gray-300 hover:text-white">Lowongan</a>
            <a href="#perusahaan" class="mb-2 block text-sm text-gray-300 hover:text-white">Perusahaan</a>
            <a href="#tips" class="mb-2 block text-sm text-gray-300 hover:text-white">Tips Karir</a>
        </div>

        <!-- KOLOM 3: PERUSAHAAN -->
        <div>
            <h3 class="mb-5 font-bold">Perusahaan</h3>
            <a href="#" class="mb-2 block text-sm text-gray-300 hover:text-white">NemuKerja</a>
            <a href="#" class="mb-2 block text-sm text-gray-300 hover:text-white">NemuKerja Digital</a>
        </div>

        <!-- KOLOM 4: SOSIAL MEDIA -->
        <div>
            <h3 class="mb-5 font-bold">Sosial Media</h3>
            <div class="flex gap-3">
                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg border border-white">◎</a>
                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg border border-white">f</a>
                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg border border-white">◔</a>
                <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg border border-white">@</a>
            </div>
        </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="flex h-8 items-center justify-center bg-[#ef9d00] text-[10px] font-semibold text-[#ffffff]">
        © {{ date('Y') }} NemuKerja. All Rights Reserved.
    </div>
</footer>

</body>

</html>