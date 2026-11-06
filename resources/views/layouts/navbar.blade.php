<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-[1500px] items-center justify-between px-5 py-3 lg:px-10">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/logonya.png') }}" alt="Nemu Kerja!" class="h-9 w-auto">
        </a>
        <nav class="hidden items-center gap-10 text-xs font-medium lg:flex" aria-label="Navigasi utama"
            data-home-page="{{ request()->routeIs('home') ? 'true' : 'false' }}">
            <a href="{{ route('home') }}" data-nav="home"
                @class([
                    'font-bold text-[#151442]' => request()->routeIs('home'),
                    'hover:text-[#ef9d00]' => !request()->routeIs('home'),
                ])>Beranda</a>
            <a href="{{ route('lowongan.index') }}" data-nav="lowongan"
                @class([
                    'font-bold text-[#151442]' => request()->routeIs('jobs.index', 'job.*'),
                    'hover:text-[#ef9d00]' => !request()->routeIs('jobs.index', 'job.*'),
                ])>Lowongan</a>
            <a href="{{ route('companies.index') }}" data-nav="companies"
                @class([
                    'font-bold text-[#151442]' => request()->routeIs('companies.index'),
                    'hover:text-[#ef9d00]' => !request()->routeIs('companies.index'),
                ])>Perusahaan</a>
            <a href="{{ route('tips.index') }}" data-nav="tips" class="hover:text-[#ef9d00]">Tips Karir</a>
        </nav>
        <div class="flex items-center gap-2">
            @auth
                <details class="group relative">
                    <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full border border-gray-200 px-3 py-2 text-xs font-semibold text-[#151442] hover:border-[#151442]">
                        <span>{{ auth()->user()->username }}</span>
                        <span aria-hidden="true" class="transition-transform group-open:rotate-180">⌄</span>
                    </summary>
                    <div class="absolute right-0 z-50 mt-2 w-52 rounded-xl border border-gray-100 bg-white p-2 text-xs shadow-lg">
                        @if (! auth()->user()->isSuperadmin() || auth()->user()->companies()->exists())
                            @if (auth()->user()->companies()->exists())
                                <a href="{{ route('company.profile.index') }}" class="block rounded-lg px-3 py-2 hover:bg-gray-50">Perusahaan Saya</a>
                            @else
                                <a href="{{ route('company.profile.create') }}" class="block rounded-lg px-3 py-2 hover:bg-gray-50">Tambah Perusahaan</a>
                            @endif
                        @endif
                        @if (auth()->user()->isCompanyAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-gray-50">Admin Page</a>
                        @elseif (auth()->user()->isSuperadmin())
                            <a href="{{ route('superadmin.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-gray-50">Admin Page</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full rounded-lg px-3 py-2 text-left hover:bg-gray-50">Keluar</button>
                        </form>
                    </div>
                </details>
            @else
                <a href="{{ route('login') }}" class="rounded-full border border-[#151442] px-4 py-1 text-xs font-semibold">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-full bg-[#151442] px-4 py-1 text-xs font-semibold text-white">Daftar</a>
            @endauth
            <img src="{{ asset('images/panda_blue.png') }}" alt="Profil" class="ml-1 h-8 w-auto">
        </div>
    </div>
</header>

<script>
    (() => {
        const navigation = document.querySelector('[data-home-page]');
        const links = document.querySelectorAll('[data-nav]');

        const updateActiveNav = () => {
            const isHome = navigation?.dataset.homePage === 'true';
            if (!isHome) {
                return;
            }

            const activeNav = window.location.hash === '#lowongan' ? 'jobs' : 'home';

            links.forEach((link) => {
                const isActive = activeNav === link.dataset.nav;

                link.classList.toggle('font-bold', isActive);
                link.classList.toggle('font-medium', !isActive);
                link.classList.toggle('text-[#151442]', isActive);
                link.classList.toggle('hover:text-[#ef9d00]', !isActive);

                if (isActive) {
                    link.setAttribute('aria-current', 'page');
                } else {
                    link.removeAttribute('aria-current');
                }
            });
        };

        window.addEventListener('hashchange', updateActiveNav);
        updateActiveNav();
    })();
</script>
