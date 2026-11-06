@extends('layouts.app')

@section('title', 'Tambah Perusahaan')

@section('content')
    <section class="mx-auto max-w-3xl px-5 py-10 lg:px-0">
        <a href="{{ route('company.profile.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#151442]">← Kembali ke Perusahaan Saya</a>
        <h1 class="mt-4 text-3xl font-extrabold text-[#151442]">Ajukan Perusahaan</h1>
        <p class="mt-2 text-sm text-gray-500">Unggah dokumen legalitas. Perusahaan akan berstatus menunggu sampai diperiksa superadmin.</p>

        <form action="{{ route('company.profile.store') }}" method="POST" enctype="multipart/form-data" class="mt-7 space-y-5 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            <div class="grid gap-5 sm:grid-cols-2">
                <label class="text-xs font-semibold">Nama perusahaan
                    <input name="name" value="{{ old('name') }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="text-xs font-semibold">Slug
                    <input name="slug" value="{{ old('slug') }}" required maxlength="255" pattern="[A-Za-z0-9_-]+" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="text-xs font-semibold">Nama badan usaha
                    <input name="legal_name" value="{{ old('legal_name') }}" maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="text-xs font-semibold">Wilayah
                    <input name="region" value="{{ old('region') }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="text-xs font-semibold">Nama pemilik
                    <input name="owner_name" value="{{ old('owner_name', auth()->user()->name) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="text-xs font-semibold">Jumlah outlet
                    <input name="outlets_count" type="number" min="1" value="{{ old('outlets_count', 1) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
            </div>
            <label class="block text-xs font-semibold">Dokumen legalitas (PDF/JPG/PNG, maks. 10 MB)
                <input name="document" type="file" accept=".pdf,.jpg,.jpeg,.png" required class="mt-2 block w-full text-sm text-gray-600">
            </label>
            <label class="block text-xs font-semibold">Logo perusahaan (opsional, maks. 2 MB)
                <input name="logo" type="file" accept=".jpg,.jpeg,.png,.webp" class="mt-2 block w-full text-sm text-gray-600">
            </label>
            <button type="submit" class="rounded-full bg-[#151442] px-6 py-3 text-sm font-semibold text-white hover:bg-[#25236b]">Kirim untuk verifikasi</button>
        </form>
    </section>
@endsection
