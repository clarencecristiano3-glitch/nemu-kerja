<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>NemuKerja! - Temukan Karir Impianmu</title>

    <link rel="stylesheet"
          href="{{ asset('css/home.css') }}">
</head>

<body>

<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <a href="{{ route('home') }}"
       class="brand">

        <div class="brand-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="brand-text">
            Nemu<br>
            Kerja<span>!</span>
        </div>

    </a>


    <nav class="navigation">

        <a href="{{ route('home') }}"
           class="active">
            Beranda
        </a>

        <a href="#lowongan">
            Lowongan
        </a>

        <a href="#perusahaan">
            Perusahaan
        </a>

        <a href="#tips">
            Tips Karir
        </a>

    </nav>


    <div class="navbar-buttons">

        <a href="#"
           class="login">
            Masuk
        </a>

        <a href="#"
           class="register">
            Daftar
        </a>

        <button class="profile-button">
            ◉ᴥ◉
        </button>

    </div>

</header>


<!-- ================= HERO ================= -->

<section class="hero">

    <div class="hero-left">

        <div class="small-title">
            TEMUKAN PEKERJAAN TERBAIK
        </div>


        <h1>
            Stop Jobless.
            <br>
            Temukan Karir
            <span>Impianmu!</span>
        </h1>


        <p class="description">
            Ribuan lowongan kerja siap menantimu.
            Nemu Kerja!<br>
            membantu kamu seperti pahlawan super.
        </p>


        <!-- SEARCH -->

        <form id="searchForm"
              class="search-box">

            <div class="search-input">

                <span>⌕</span>

                <input
                    type="text"
                    id="keyword"
                    placeholder="Kata Kunci Pekerjaan">

            </div>


            <div class="search-line"></div>


            <div class="search-input">

                <span>⌖</span>

                <input
                    type="text"
                    id="location"
                    placeholder="Lokasi Pekerjaan">

            </div>


            <button type="submit">
                Cari
            </button>

        </form>


        <!-- CATEGORY -->

        <div class="popular">

            <h2>
                Kategori Pekerjaan Populer
            </h2>


            <div class="categories">

                @foreach($categories as $category)

                    <button
                        class="category"
                        data-category="{{ $category['name'] }}">

                        <div class="category-icon
                            icon-{{ $category['icon'] }}">
                        </div>

                        <span>
                            {{ $category['name'] }}
                        </span>

                    </button>

                @endforeach

            </div>

        </div>

    </div>


    <!-- ================= HERO IMAGE ================= -->

    <div class="hero-right">

        <div class="document document-blue">
            <strong>
                Dokumentasi<br>
                Webinar
            </strong>

            <small>
                Career & Digital
            </small>
        </div>


        <div class="document document-purple">

            <strong>
                Webinar Navigation
            </strong>

            <small>
                Future Development
            </small>

        </div>


        <div class="person">

            <div class="cap">
                ◉
            </div>

            <div class="head"></div>

            <div class="neck"></div>

            <div class="body"></div>

            <div class="laptop">

                <div></div>

            </div>

        </div>

    </div>

</section>


<!-- ================= JOB SECTION ================= -->

<section
    class="jobs"
    id="lowongan">

    <div class="jobs-header">

        <h2>
            Cari Pekerjaanmu Sekarang!
        </h2>


        <button
            id="filterButton"
            class="filter-button">

            Filter

            <span>
                ☰
            </span>

        </button>

    </div>


    <!-- FILTER -->

    <div
        id="filterPanel"
        class="filter-panel">

        <button
            class="filter active"
            data-filter="all">

            Semua

        </button>


        <button
            class="filter"
            data-filter="Pelayanan">

            Pelayanan

        </button>


        <button
            class="filter"
            data-filter="Design UI/UX">

            Design UI/UX

        </button>


        <button
            class="filter"
            data-filter="Data Analytic">

            Data Analytic

        </button>


        <button
            class="filter"
            data-filter="Teknik">

            Teknik

        </button>


        <button
            class="filter"
            data-filter="Operasional">

            Operasional

        </button>

    </div>


    <!-- JOB CARDS -->

    <div
        class="job-grid"
        id="jobGrid">

        @foreach($jobs as $job)

            <div
                class="job-card"
                data-category="{{ $job['category'] }}"
                data-search="{{ strtolower($job['company'].' '.$job['position'].' '.$job['location'].' '.$job['education']) }}">


                <div class="job-logo
                    logo-{{ $job['style'] }}">

                    <span>
                        {{ $job['logo'] }}
                    </span>

                </div>


                <div class="job-content">

                    <h3>
                        {{ $job['company'] }}
                    </h3>


                    <p>
                        Mencari :
                        {{ $job['position'] }}
                    </p>


                    <p>
                        Minimal Lulusan :
                        {{ $job['education'] }}
                    </p>


                    <p>
                        Maksimal Umur :
                        {{ $job['age'] }}
                    </p>


                    <small>
                        {{ $job['needed'] }}
                        orang di butuhkan
                    </small>

                </div>

            </div>

        @endforeach

    </div>


    <!-- EMPTY -->

    <div
        id="empty"
        class="empty">

        <h3>
            Lowongan tidak ditemukan
        </h3>

        <p>
            Coba kata kunci atau kategori lain.
        </p>

    </div>


    <button
        class="see-more">

        see more

    </button>

</section>


<!-- ================= FOOTER ================= -->

<footer
    class="footer"
    id="perusahaan">


    <div class="footer-panda">
        ◉ᴥ◉
    </div>


    <div class="footer-container">


        <div class="footer-brand">

            <h2>
                Nemu<br>
                Kerja<span>!</span>
            </h2>

            <small>
                “Solusi cepat temukan
                pekerjaan paling tepat.”
            </small>

        </div>


        <div class="footer-column">

            <h3>
                Navigasi Cepat
            </h3>

            <a href="#">
                Home
            </a>

            <a href="#lowongan">
                Lowongan
            </a>

            <a href="#perusahaan">
                Perusahaan
            </a>

            <a href="#tips"
               id="tips">
                Tips Karir
            </a>

        </div>


        <div class="footer-column">

            <h3>
                Perusahaan
            </h3>

            <a href="#">
                NemuKerja
            </a>

            <a href="#">
                NemuKerja Digital
            </a>

        </div>


        <div class="footer-column">

            <h3>
                Sosial Media
            </h3>


            <div class="social">

                <a href="#">
                    ◎
                </a>

                <a href="#">
                    f
                </a>

                <a href="#">
                    ◔
                </a>

                <a href="#">
                    @
                </a>

            </div>

        </div>

    </div>


    <div class="copyright">

        © {{ date('Y') }}
        NemuKerja. All Rights Reserved.

    </div>

</footer>


<script src="{{ asset('js/home.js') }}"></script>

</body>

</html>