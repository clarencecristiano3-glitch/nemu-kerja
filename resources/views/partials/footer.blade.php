<footer id="perusahaan" class="bg-[#19194f] text-white">
    <div class="mx-auto grid min-h-[186px] max-w-[950px] grid-cols-2 items-center gap-x-8 gap-y-7 px-6 py-8 sm:px-8 lg:grid-cols-[293px_207px_177px_1fr] lg:gap-0 lg:px-0 lg:py-0">
        <div class="col-span-2 flex flex-col justify-center border-b border-white/30 pb-6 lg:col-span-1 lg:min-h-[120px] lg:border-b-0 lg:border-r lg:pb-0">
            <a href="{{ route('home') }}" class="inline-block" aria-label="Nemu Kerja - Beranda">
                <img src="{{ asset('images/logo putih.png') }}" alt="Nemu Kerja!" class="h-[68px] w-auto">
            </a>
            <p class="mt-2 text-[9px] text-gray-300">“Solusi cepat temukan pekerjaan paling tepat.”</p>
        </div>

        <nav class="text-[11px] lg:pl-[72px]" aria-label="Navigasi footer">
            <h2 class="mb-2 text-[17px] font-semibold leading-5">Navigasi Cepat</h2>
            <a href="{{ route('home') }}" class="block leading-[1.45] text-gray-200 hover:text-white">Home</a>
            <a href="{{ route('jobs.index') }}" class="block leading-[1.45] text-gray-200 hover:text-white">Lowongan</a>
            <a href="{{ route('home') }}#perusahaan" class="block leading-[1.45] text-gray-200 hover:text-white">Perusahaan</a>
            <a href="#" class="block leading-[1.45] text-gray-200 hover:text-white">Tips Karir</a>
        </nav>

        <div class="text-[11px]">
            <h2 class="mb-2 text-[17px] font-semibold leading-5">Perusahaan</h2>
            <a href="#" class="block leading-[1.45] text-gray-200 hover:text-white">NemuKerja</a>
            <a href="#" class="block leading-[1.45] text-gray-200 hover:text-white">NemuKerja Digital</a>
        </div>

        <div class="text-[11px]">
            <h2 class="mb-2 text-[17px] font-semibold leading-5">Sosial Media</h2>
            <div class="flex gap-1.5">
                <a href="#" aria-label="Instagram" class="flex h-[22px] w-[22px] items-center justify-center rounded-md bg-white text-sm font-bold leading-none text-[#19194f]">◎</a>
                <a href="#" aria-label="Facebook" class="flex h-[22px] w-[22px] items-center justify-center rounded-md bg-white text-sm font-bold leading-none text-[#19194f]">f</a>
                <a href="#" aria-label="WhatsApp" class="flex h-[22px] w-[22px] items-center justify-center rounded-md bg-white text-sm font-bold leading-none text-[#19194f]">◔</a>
                <a href="#" aria-label="TikTok" class="flex h-[22px] w-[22px] items-center justify-center rounded-md bg-white text-sm font-bold leading-none text-[#19194f]">♪</a>
            </div>
        </div>
    </div>

    <div class="bg-[#ed9d00] py-[5px] text-center text-[8px] leading-[11px] text-white">
        &copy; {{ date('Y') }} NemuKerja. All Rights Reserved.
    </div>
</footer>
