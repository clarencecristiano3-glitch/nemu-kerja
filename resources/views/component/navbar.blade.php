<header class="
    sticky top-0 z-50
    border-b border-gray-200
    bg-white
">

    <div class="
        mx-auto flex max-w-[1500px]
        items-center
        justify-between
        px-6 py-5
        lg:px-10
    ">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">

            <div class="
                flex h-12 w-12
                items-end justify-center
                gap-1
                rounded-full
                bg-[#151442]
                pb-2
            ">
                <span class="h-4 w-1.5 rounded bg-white"></span>
                <span class="h-7 w-1.5 rounded bg-white"></span>
                <span class="h-5 w-1.5 rounded bg-white"></span>
            </div>

            <div class="
                text-xl font-extrabold
                leading-[.8]
            ">
                Nemu<br>
                Kerja<span class="text-[#ef9d00]">!</span>
            </div>

        </a>


        {{-- NAVIGATION --}}
        <nav class="
            hidden items-center
            gap-12
            lg:flex
        ">

            <a
                href="{{ route('home') }}"
                class="font-bold"
            >
                Beranda
            </a>

            <a
                href="#lowongan"
                class="hover:text-[#ef9d00]"
            >
                Lowongan
            </a>

            <a
                href="#perusahaan"
                class="hover:text-[#ef9d00]"
            >
                Perusahaan
            </a>

            <a
                href="#tips"
                class="hover:text-[#ef9d00]"
            >
                Tips Karir
            </a>

        </nav>


        {{-- BUTTON --}}
        <div class="flex items-center gap-3">

            <a
                href="#"
                class="
                    rounded-full
                    border border-[#151442]
                    px-6 py-2
                    text-sm font-semibold
                    text-[#151442]
                    transition
                    hover:bg-[#151442]
                    hover:text-white
                "
            >
                Masuk
            </a>

            <a
                href="#"
                class="
                    rounded-full
                    bg-[#151442]
                    px-6 py-2
                    text-sm font-semibold
                    text-white
                    transition
                    hover:bg-[#24215f]
                "
            >
                Daftar
            </a>

            <button
                type="button"
                class="
                    hidden text-3xl
                    lg:block
                "
            >
                ◉ᴥ◉
            </button>

        </div>

    </div>

</header>