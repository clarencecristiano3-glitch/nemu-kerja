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
            <a href="{{ route('home') }}#lowongan" data-nav="jobs"
                @class([
                    'font-bold text-[#151442]' => request()->routeIs('job.detail', 'job.apply'),
                    'hover:text-[#ef9d00]' => !request()->routeIs('job.detail', 'job.apply'),
                ])>Lowongan</a>
            <a href="{{ route('companies.index') }}" data-nav="companies"
                @class([
                    'font-bold text-[#151442]' => request()->routeIs('companies.index'),
                    'hover:text-[#ef9d00]' => !request()->routeIs('companies.index'),
                ])>Perusahaan</a>
            <a href="#" data-nav="tips" class="hover:text-[#ef9d00]">Tips Karir</a>
        </nav>
        <div class="flex items-center gap-2">
            <a href="{{ route('login') }}" class="rounded-full border border-[#151442] px-4 py-1 text-xs font-semibold">Masuk</a>
            <a href="{{ route('register') }}" class="rounded-full bg-[#151442] px-4 py-1 text-xs font-semibold text-white">Daftar</a>
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
