<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-[1500px] flex-wrap items-center justify-between gap-4 px-5 py-3 lg:px-10">
        <a href="{{ route('admin.dashboard') }}" class="flex shrink-0 items-center">
            <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-9 w-auto">
        </a>

        <nav class="order-3 flex w-full flex-wrap items-center justify-center gap-x-6 gap-y-3 text-xs font-medium lg:order-2 lg:w-auto lg:gap-9"
            aria-label="Navigasi admin">
            <a href="{{ route('admin.vacancies.index') }}"
                @class(['font-bold text-[#151442]' => request()->routeIs('admin.vacancies.*'), 'hover:text-[#ef9d00]' => !request()->routeIs('admin.vacancies.*')])>
                Daftar Lowongan
            </a>
            <a href="{{ route('admin.companies.index') }}"
                @class(['font-bold text-[#151442]' => request()->routeIs('admin.companies.*'), 'hover:text-[#ef9d00]' => !request()->routeIs('admin.companies.*')])>
                Daftar Perusahaan
            </a>
            <a href="{{ route('admin.applications.index') }}"
                @class(['font-bold text-[#151442]' => request()->routeIs('admin.applications.*'), 'hover:text-[#ef9d00]' => !request()->routeIs('admin.applications.*')])>
                Verifikasi Lamaran
            </a>
            <a href="{{ route('admin.verifications.index') }}"
                @class(['font-bold text-[#151442]' => request()->routeIs('admin.verifications.*'), 'hover:text-[#ef9d00]' => !request()->routeIs('admin.verifications.*')])>
                Verifikasi Perusahaan
            </a>
            <a href="{{ route('admin.career-tips.index') }}"
                @class(['font-bold text-[#151442]' => request()->routeIs('admin.career-tips.*'), 'hover:text-[#ef9d00]' => !request()->routeIs('admin.career-tips.*')])>
                Daftar Tips
            </a>
        </nav>

        <div class="order-2 flex items-center gap-3 lg:order-3">
            <span class="rounded-full bg-[#151442] px-5 py-1 text-[10px] font-semibold text-white">Admin</span>
            <span class="hidden text-xs font-medium sm:inline">{{ auth()->user()->username }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-full border border-[#151442] px-4 py-1 text-xs font-semibold hover:bg-[#151442] hover:text-white">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</header>
