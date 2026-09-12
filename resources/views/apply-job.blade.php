<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lamar Pekerjaan - Nemu Kerja!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-[#151442] antialiased">
    @include('layouts.navbar')

    <main class="mx-auto max-w-[1360px] px-5 py-10 lg:px-14 lg:py-12">
        <section class="grid items-center overflow-hidden rounded-[22px] bg-white shadow-[0_4px_16px_rgba(0,0,0,0.16)] lg:grid-cols-[178px_1fr_170px]">
            <div class="flex h-44 items-center justify-center bg-[#ed0015] lg:h-44">
                <div class="text-center font-black leading-none text-white">
                    <span class="block text-[2.5rem] tracking-[-3px]">HOTWAY'S</span>
                    <span class="mt-2 block text-[0.65rem] font-bold tracking-[3px]">FRIED CHICKEN</span>
                </div>
            </div>
            <div class="px-6 py-6 lg:px-7">
                <h1 class="text-2xl font-extrabold leading-tight tracking-tight lg:text-[25px]">Hotway's - Part time</h1>
                <p class="mt-1 text-xs text-[#777595]">Pontianak, Jl. Merdeka No 23 | PT Lingga Jaya Utama</p>
                <div class="mt-3 grid gap-1 text-[11px] leading-snug">
                    <p>Mencari: Pelayanan</p>
                    <p>Minimal Lulusan: SMA/SMK</p>
                    <p>Maksimal Umur: 24</p>
                </div>
                <div class="mt-4 max-w-[420px]">
                    <div class="h-3 overflow-hidden rounded-full bg-[#f8e8bf]"><div class="h-full w-[70%] rounded-full bg-[#ed9d00]"></div></div>
                    <div class="mt-1 flex justify-between text-[9px] text-[#777595]"><span class="font-semibold text-[#151442]">Pelamar saat ini: 7</span><span>7/10</span></div>
                </div>
            </div>
            <div class="border-t border-gray-100 px-6 py-5 text-center lg:border-l lg:border-t-0">
                <p class="text-xs font-bold">Waktu Tersisa</p>
                <p class="mt-1 text-6xl font-black leading-none tracking-tight">06</p>
                <p class="mt-1 text-[10px] tracking-[7px]">Hari</p>
            </div>
        </section>

        <form class="mt-5" onsubmit="event.preventDefault()">
            <section class="grid gap-8 lg:grid-cols-2 lg:gap-16">
                <div class="space-y-4">
                    <label class="block text-[10px] font-medium" for="full_name">Nama Lengkap</label>
                    <input id="full_name" name="full_name" type="text" class="-mt-3 h-10 w-full rounded-full border border-gray-200 px-4 text-sm shadow-[0_2px_7px_rgba(0,0,0,0.14)] outline-none focus:border-[#151442]" required>
                    <label class="block text-[10px] font-medium" for="age">Umur</label>
                    <input id="age" name="age" type="number" min="15" max="70" class="-mt-3 h-10 w-full rounded-full border border-gray-200 px-4 text-sm shadow-[0_2px_7px_rgba(0,0,0,0.14)] outline-none focus:border-[#151442]" required>
                    <label class="block text-[10px] font-medium" for="education">Lulusan Terakhir</label>
                    <select id="education" name="education" class="-mt-3 h-10 w-full rounded-full border border-gray-200 bg-white px-4 text-sm shadow-[0_2px_7px_rgba(0,0,0,0.14)] outline-none focus:border-[#151442]" required>
                        <option value="">Pilih pendidikan terakhir</option>
                        <option>SMA/SMK</option>
                        <option>D1/D3</option>
                        <option>S1</option>
                    </select>
                    <label class="block text-[10px] font-medium" for="email">Alamat Email</label>
                    <input id="email" name="email" type="email" class="-mt-3 h-10 w-full rounded-full border border-gray-200 px-4 text-sm shadow-[0_2px_7px_rgba(0,0,0,0.14)] outline-none focus:border-[#151442]" required>
                </div>
                <div class="border-l border-gray-100 pl-8 lg:pl-16">
                    <h2 class="text-xl font-extrabold lg:text-2xl">Upload CV <span class="font-semibold">| Surat Lamaran</span></h2>
                    <label for="application_file" class="mt-3 flex h-32 cursor-pointer items-center justify-center border-2 border-dotted border-white bg-[#151442] text-center text-white outline-2 outline-[#151442] outline-offset-[-5px] hover:bg-[#211f5d]">
                        <span id="file_name" class="px-5 text-sm">Masukkan file!<small class="mt-1 block text-[9px] tracking-[4px] text-gray-300">(Max : 10mb)</small></span>
                        <input id="application_file" name="application_file" type="file" accept=".pdf,.doc,.docx" class="sr-only" required>
                    </label>
                </div>
            </section>
            <button type="submit" class="mt-9 w-full rounded-full bg-[#ed9d00] py-3 text-sm font-bold text-white shadow-sm hover:bg-[#d88d00]">Kirim Lamaran</button>
        </form>
    </main>

    <footer class="relative mt-5 bg-[#151442] text-white">
        <div class="absolute -top-12 right-5 lg:right-10"><img src="{{ asset('images/koala.png') }}" alt="Maskot Nemu Kerja!" class="h-16 w-auto"></div>
        <div class="mx-auto grid max-w-[1360px] gap-8 px-6 py-9 sm:grid-cols-2 lg:grid-cols-4 lg:px-14">
            <div><img src="{{ asset('images/logo putih.png') }}" alt="Nemu Kerja!" class="h-14 w-auto"><p class="mt-3 text-[10px] text-gray-300">Solusi cepat temukan pekerjaan paling tepat.</p></div>
            <div class="text-xs"><h2 class="mb-3 font-bold">Navigasi Cepat</h2><a href="{{ route('home') }}" class="block text-gray-300">Home</a><a href="{{ route('home') }}#lowongan" class="block text-gray-300">Lowongan</a><a href="{{ route('companies.index') }}" class="block text-gray-300">Perusahaan</a><a href="#" class="block text-gray-300">Tips Karir</a></div>
            <div class="text-xs"><h2 class="mb-3 font-bold">Perusahaan</h2><a href="#" class="block text-gray-300">NemuKerja</a><a href="#" class="block text-gray-300">NemuKerja Digital</a></div>
            <div class="text-xs"><h2 class="mb-3 font-bold">Sosial Media</h2><div class="flex gap-2"><a href="#" aria-label="Instagram" class="flex h-7 w-7 items-center justify-center rounded border border-white">◎</a><a href="#" aria-label="Facebook" class="flex h-7 w-7 items-center justify-center rounded border border-white">f</a><a href="#" aria-label="WhatsApp" class="flex h-7 w-7 items-center justify-center rounded border border-white">◔</a><a href="#" aria-label="TikTok" class="flex h-7 w-7 items-center justify-center rounded border border-white">♪</a></div></div>
        </div>
        <div class="bg-[#ef9d00] py-1 text-center text-[9px]">© {{ date('Y') }} NemuKerja. All Rights Reserved.</div>
    </footer>

    <script>
        document.getElementById('application_file').addEventListener('change', function () {
            const fileName = document.getElementById('file_name');
            fileName.textContent = this.files.length ? this.files[0].name : 'Masukkan file!';
        });
    </script>
</body>
</html>
