<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job['title'] }} - Nemu Kerja!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-[#151442] antialiased">
    <header class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-[1500px] items-center justify-between px-5 py-3 lg:px-10">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-9 w-auto">
            </a>
            <nav class="hidden items-center gap-10 text-xs font-medium lg:flex">
                <a href="{{ route('home') }}" class="hover:text-[#ef9d00]">Beranda</a>
                <a href="{{ route('home') }}#lowongan" class="hover:text-[#ef9d00]">Lowongan</a>
                <a href="{{ route('companies.index') }}" class="hover:text-[#ef9d00]">Perusahaan</a>
                <a href="#" class="hover:text-[#ef9d00]">Tips Karir</a>
            </nav>
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="rounded-full border border-[#151442] px-4 py-1 text-xs font-semibold">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-full bg-[#151442] px-4 py-1 text-xs font-semibold text-white">Daftar</a>
                <img src="{{ asset('images/panda_blue.png') }}" alt="Profil" class="ml-1 h-8 w-auto">
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-[1360px] px-5 py-10 lg:px-14 lg:py-12">
        <section class="grid items-center overflow-hidden rounded-[22px] bg-white shadow-[0_4px_16px_rgba(0,0,0,0.16)] lg:grid-cols-[178px_1fr_170px]">
            <div class="flex h-44 items-center justify-center bg-[#ed0015] lg:h-44">
                <div class="text-center font-black leading-none text-white">
                    <span class="block text-[2.5rem] tracking-[-3px]">HOTWAY'S</span>
                    <span class="mt-2 block text-[0.65rem] font-bold tracking-[3px]">FRIED CHICKEN</span>
                </div>
            </div>
            <div class="px-6 py-6 lg:px-7">
                <h1 class="text-2xl font-extrabold leading-tight tracking-tight lg:text-[25px]">{{ $job['title'] }}</h1>
                <p class="mt-1 text-xs text-[#777595]">{{ $job['company'] }}</p>
                <div class="mt-3 grid gap-1 text-[11px] leading-snug text-[#151442] sm:grid-cols-2">
                    <p>Mencari: {{ $job['category'] }}</p>
                    <p>Minimal Lulusan: {{ $job['education'] }}</p>
                    <p>Maksimal Umur: {{ $job['age'] }}</p>
                </div>
                <div class="mt-4 max-w-[420px]">
                    <div class="h-3 overflow-hidden rounded-full bg-[#f8e8bf]">
                        <div class="h-full w-[70%] rounded-full bg-[#ed9d00]"></div>
                    </div>
                    <div class="mt-1 flex justify-between text-[9px] text-[#777595]">
                        <span class="font-semibold text-[#151442]">Pelamar saat ini: {{ $job['applicants'] }}</span>
                        <span>{{ $job['applicants'] }}/{{ $job['quota'] }}</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-100 px-6 py-5 text-center lg:border-l lg:border-t-0">
                <p class="text-xs font-bold">Waktu Tersisa</p>
                <p class="mt-1 text-6xl font-black leading-none tracking-tight">{{ str_pad($job['remaining_days'], 2, '0', STR_PAD_LEFT) }}</p>
                <p class="mt-1 text-[10px] tracking-[7px]">Hari</p>
            </div>
        </section>

        <section class="mt-6 grid gap-4 md:grid-cols-2">
            <article class="min-h-[158px] rounded-xl border border-gray-200 bg-white px-7 py-5 shadow-sm">
                <h2 class="text-base font-extrabold">Tanggung Jawab</h2>
                <ul class="mt-3 list-disc space-y-1 pl-3 text-[10px] leading-snug text-[#35335c] marker:text-[#151442]">
                    <li>Melayani pelanggan dengan ramah dan profesional di area frontline / kasir.</li>
                    <li>Memproses pesanan pelanggan serta mengelola transaksi pembayaran.</li>
                    <li>Menyiapkan dan menyajikan produk makanan atau minuman sesuai standar SOP.</li>
                    <li>Menjaga kebersihan, kerapian, dan kenyamanan area restoran.</li>
                    <li>Membantu proses penerimaan stok bahan baku dan pengecekan inventoris harian.</li>
                </ul>
            </article>

            <article class="min-h-[158px] rounded-xl border border-gray-200 bg-white px-7 py-5 shadow-sm">
                <h2 class="text-base font-extrabold">Kualifikasi</h2>
                <ul class="mt-3 list-disc space-y-1 pl-3 text-[10px] leading-snug text-[#35335c] marker:text-[#151442]">
                    <li>Pria / Wanita, usia maksimal 23 tahun.</li>
                    <li>Pendidikan minimal SMA / SMK sederajat (terbuka untuk siswa aktif / mahasiswa).</li>
                    <li>Berpenampilan menarik, rapi, ramah, dan memiliki komunikasi yang baik.</li>
                    <li>Mampu bekerja secara efisien, jujur, serta tanggap dalam tim.</li>
                    <li>Bersedia bekerja dengan sistem shift, termasuk pada akhir pekan (weekend) atau hari libur nasional.</li>
                </ul>
            </article>

            <article class="min-h-[158px] rounded-xl border border-gray-200 bg-white px-7 py-5 shadow-sm">
                <h2 class="text-base font-extrabold">Jadwal Kerja</h2>
                <ul class="mt-3 list-disc space-y-1 pl-3 text-[10px] leading-snug text-[#35335c] marker:text-[#151442]">
                    <li>Sistem kerja: Part-time / Shift (4-6 jam per hari).</li>
                    <li>Pilihan shift:
                        <ul class="list-[circle] pl-3">
                            <li>Shift 1: 10:00 WIB - 16:00 WIB</li>
                            <li>Shift 2: 16:00 WIB - 21:00 WIB</li>
                        </ul>
                    </li>
                    <li>Frekuensi: 4-5 hari kerja per minggu (fleksibel disesuaikan dengan jadwal kuliah/sekolah).</li>
                </ul>
            </article>
            
            <article class="min-h-[158px] rounded-xl border border-gray-200 bg-white px-7 py-5 shadow-sm">
                <h2 class="text-base font-extrabold">Gaji &amp; Benefit</h2>
                <ul class="mt-3 list-disc space-y-1 pl-3 text-[10px] leading-snug text-[#35335c] marker:text-[#151442]">
                    <li>Gaji Pokok / Kompensasi: Rp800.000 - Rp1.500.000 / bulan (dihitung berdasarkan jam kerja / hourly rate).</li>
                    <li>Makan Siang / Catering: Disediakan meal allowance atau makan gratis 1x per shift.</li>
                    <li>Tunjangan &amp; Bonus:
                        <ul class="list-[circle] pl-3">
                            <li>Tunjangan kehadiran / shift allowance.</li>
                            <li>Insentif pencapaian target penjualan bulanan.</li>
                        </ul>
                    </li>
                    <li>Pengembangan Diri: Pelatihan standar hospitality &amp; pelayanan F&amp;B modern.</li>
                </ul>
            </article>
        </section>

        <a href="{{ route('job.apply') }}" class="mt-9 block rounded-full bg-[#ed9d00] py-3 text-center text-sm font-bold text-white shadow-sm hover:bg-[#d88d00]">Lamar Sekarang!</a>
    </main>

    <footer class="relative mt-5 bg-[#151442] text-white">
        <div class="absolute -top-12 right-5 lg:right-10">
            <img src="{{ asset('images/koala.png') }}" alt="Maskot Nemu Kerja!" class="h-16 w-auto">
        </div>
        <div class="mx-auto grid max-w-[1360px] gap-8 px-6 py-9 sm:grid-cols-2 lg:grid-cols-4 lg:px-14">
            <div>
                <img src="{{ asset('images/logo putih.png') }}" alt="Nemu Kerja!" class="h-14 w-auto">
                <p class="mt-3 text-[10px] text-gray-300">“Solusi cepat temukan pekerjaan paling tepat.”</p>
            </div>
            <div class="text-xs">
                <h2 class="mb-3 font-bold">Navigasi Cepat</h2>
                <a href="{{ route('home') }}" class="block text-gray-300">Home</a>
                <a href="{{ route('home') }}#lowongan" class="block text-gray-300">Lowongan</a>
                <a href="{{ route('home') }}#perusahaan" class="block text-gray-300">Perusahaan</a>
                <a href="#" class="block text-gray-300">Tips Karir</a>
            </div>
            <div class="text-xs">
                <h2 class="mb-3 font-bold">Perusahaan</h2>
                <a href="#" class="block text-gray-300">NemuKerja</a>
                <a href="#" class="block text-gray-300">NemuKerja Digital</a>
            </div>
            <div class="text-xs">
                <h2 class="mb-3 font-bold">Sosial Media</h2>
                <div class="flex gap-2">
                    <a href="#" aria-label="Instagram" class="flex h-7 w-7 items-center justify-center rounded border border-white">◎</a>
                    <a href="#" aria-label="Facebook" class="flex h-7 w-7 items-center justify-center rounded border border-white">f</a>
                    <a href="#" aria-label="WhatsApp" class="flex h-7 w-7 items-center justify-center rounded border border-white">◔</a>
                    <a href="#" aria-label="TikTok" class="flex h-7 w-7 items-center justify-center rounded border border-white">♪</a>
                </div>
            </div>
        </div>
        <div class="bg-[#ef9d00] py-1 text-center text-[9px]">© {{ date('Y') }} NemuKerja. All Rights Reserved.</div>
    </footer>
</body>

</html>