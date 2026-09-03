<footer class="site-footer">
  <div class="footer-panda" aria-hidden="true">
    <img src="{{ asset('images/koala.png') }}" alt="Koala">
</div>

    <div class="footer-inner">
        <div class="footer-brand">
            <div class="footer-logo">Nemu<br><span>Kerja!</span></div>
            <p>“Solusi cepat temukan pekerjaan paling tepat.”</p>
        </div>

        <div class="footer-col">
            <h3>Navigasi Cepat</h3>
            <a href="#">Home</a>
            <a href="#">Lowongan</a>
            <a href="{{ route('companies.index') }}">Perusahaan</a>
            <a href="#">Tips Karir</a>
        </div>

        <div class="footer-col">
            <h3>Perusahaan</h3>
            <a href="#">NemuKerja</a>
            <a href="#">NemuKerja Digital</a>
        </div>

        <div class="footer-col">
            <h3>Sosial Media</h3>
            <div class="socials">
                <a href="#" aria-label="Instagram">◎</a>
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="WhatsApp">◔</a>
                <a href="#" aria-label="TikTok">♪</a>
            </div>
        </div>
    </div>

    <div class="copyright">
        © {{ date('Y') }} NemuKerja. All Rights Reserved.
    </div>
</footer>