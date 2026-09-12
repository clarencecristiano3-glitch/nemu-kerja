<footer class="bg-slate-900 text-white relative mt-20 pt-12 pb-6">
    <div class="absolute -top-12 right-10">
        <img src="{{ asset('images/koala.png') }}" alt="Maskot Nemu Kerja!" class="h-16 w-auto">
    </div>

    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 border-b border-slate-800 px-6 pb-8 md:grid-cols-4">
        <div>
            <img src="{{ asset('images/logo putih.png') }}" alt="Nemu Kerja!" class="h-14 w-auto">
            <p class="mt-2 text-xs text-gray-400">Solusi cepat temukan pekerjaan paling tepat.</p>
        </div>
        <div class="text-xs">
            <h4 class="mb-2 font-semibold">Navigasi Cepat</h4>
            <a href="{{ route('home') }}" class="block text-gray-400">Beranda</a>
            <a href="{{ route('home') }}#lowongan" class="block text-gray-400">Lowongan</a>
            <a href="{{ route('companies.index') }}" class="block text-gray-400">Perusahaan</a>
        </div>
        <div class="text-xs">
            <h4 class="mb-2 font-semibold">Perusahaan</h4>
            <a href="#" class="block text-gray-400">NemuKerja Digital</a>
        </div>
    </div>
    <div class="pt-4 text-center text-[10px] text-gray-500">
        &copy; {{ date('Y') }} NemuKerja. All rights reserved.
    </div>
</footer>