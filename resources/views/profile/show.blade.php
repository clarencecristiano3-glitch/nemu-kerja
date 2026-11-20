@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <section class="mx-auto max-w-5xl px-5 py-10 lg:px-0">
        <div>
            <h1 class="text-3xl font-extrabold text-[#151442]">Profil Saya</h1>
            <p class="mt-2 text-sm text-gray-500">Informasi akun dan riwayat lamaran kerja Anda.</p>
        </div>

        <div class="mt-7 grid gap-5 md:grid-cols-3">
            <article class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Total lamaran</p>
                <p class="mt-2 text-3xl font-extrabold text-[#151442]">{{ $user->job_applications_count }}</p>
            </article>
            <article class="rounded-2xl border border-green-100 bg-green-50 p-5 shadow-sm">
                <p class="text-sm text-green-800">Lamaran diterima</p>
                <p class="mt-2 text-3xl font-extrabold text-green-900">{{ $user->accepted_applications_count }}</p>
            </article>
            <article class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Bergabung sejak</p>
                <p class="mt-2 text-lg font-bold text-[#151442]">{{ $user->created_at->format('d M Y') }}</p>
            </article>
        </div>

        <section class="mt-7 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
            <h2 class="text-lg font-extrabold text-[#151442]">Data diri</h2>
            <dl class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-xs text-gray-500">Nama</dt>
                    <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Username</dt>
                    <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $user->username }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Email</dt>
                    <dd class="mt-1 break-all text-sm font-semibold text-gray-800">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Tanggal lahir</dt>
                    <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $user->birth_date?->format('d/m/Y') ?? '-' }}</dd>
                </div>
            </dl>
        </section>

        <section class="mt-10">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-extrabold text-[#151442]">Riwayat lamaran</h2>
                    <p class="mt-1 text-sm text-gray-500">Perusahaan dan posisi yang pernah Anda lamar.</p>
                </div>
            </div>

            <div class="mt-5 space-y-3">
                @forelse ($applications as $application)
                    <article class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <h3 class="font-bold text-[#151442]">{{ $application->job_title }}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $application->vacancy?->company?->name ?? $application->company_name }}</p>
                                <p class="mt-1 text-xs text-gray-500">Dilamar {{ $application->created_at->format('d M Y') }}</p>
                            </div>
                            <span @class([
                                'rounded-full px-3 py-1 text-xs font-semibold',
                                'bg-amber-50 text-amber-800' => $application->status === 'pending',
                                'bg-green-50 text-green-800' => $application->status === 'reviewed',
                                'bg-red-50 text-red-800' => $application->status === 'rejected',
                            ])>{{ ['pending' => 'Menunggu', 'reviewed' => 'Diterima', 'rejected' => 'Ditolak'][$application->status] ?? ucfirst($application->status) }}</span>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl bg-white px-6 py-12 text-center text-sm text-gray-500 shadow-sm">
                        Anda belum pernah mengirim lamaran kerja.
                        <a href="{{ route('lowongan.index') }}" class="ml-1 font-semibold text-[#151442] underline">Cari lowongan</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $applications->links() }}</div>
        </section>
    </section>
@endsection
