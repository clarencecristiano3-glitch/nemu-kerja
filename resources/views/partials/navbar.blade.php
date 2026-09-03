<header class="site-header">
    <div class="nav-wrap">
        <a class="brand" href="{{ route('companies.index') }}" aria-label="Nemu Kerja">
            <span class="brand-mark"><span></span><span></span><span></span></span>
            <span>Nemu<br>Kerja!</span>
        </a>
        <nav class="nav-links" aria-label="Navigasi utama">
            <a href="#">Beranda</a>
            <a href="#">Lowongan</a>
            <a class="active" href="{{ route('companies.index') }}">Perusahaan</a>
            <a href="#">Tips Karir</a>
        </nav>
        <div class="nav-actions">
            <a class="btn btn-login" href="#">Masuk</a>
            <a class="btn btn-register" href="#">Daftar</a>
            <span class="mini-panda" aria-hidden="true">◉</span>
        </div>
    </div>
</header>
