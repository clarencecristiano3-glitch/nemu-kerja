<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-[1500px] flex-wrap items-center justify-between gap-4 px-5 py-3 lg:px-10">
        <a href="{{ route('superadmin.dashboard') }}" class="flex shrink-0 items-center">
            <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-9 w-auto">
        </a>
        <nav class="order-3 flex w-full flex-wrap items-center justify-center gap-x-6 gap-y-3 text-xs font-medium lg:order-2 lg:w-auto" aria-label="Navigasi superadmin">
            <a href="{{ route('superadmin.dashboard') }}">Ringkasan</a>
            <a href="{{ route('superadmin.verifications.index') }}">Verifikasi Perusahaan</a>
            <a href="{{ route('superadmin.companies.index') }}">Semua Perusahaan</a>
            <a href="{{ route('superadmin.users.index') }}">Semua User</a>
            <a href="{{ route('superadmin.vacancies.index') }}">Lowongan</a>
            <a href="{{ route('superadmin.applications.index') }}">Lamaran</a>
            <a href="{{ route('superadmin.career-tips.index') }}">Tips Karier</a>
        </nav>
        <div class="order-2 flex items-center gap-3 lg:order-3">
            <span class="rounded-full bg-[#151442] px-5 py-1 text-[10px] font-semibold text-white">Superadmin</span>
            <span class="hidden text-xs font-medium sm:inline">{{ auth()->user()->username }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-full border border-[#151442] px-4 py-1 text-xs font-semibold hover:bg-[#151442] hover:text-white">Keluar</button>
            </form>
        </div>
    </div>
</header>
