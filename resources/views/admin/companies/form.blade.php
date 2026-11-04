@extends('layouts.admin')

@section('title', $company->exists ? 'Edit Perusahaan' : 'Tambah Perusahaan')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('admin.companies.index') }}" class="text-xs font-semibold text-gray-500 hover:text-[#151442]">← Kembali ke perusahaan</a>
        <h1 class="mt-3 text-3xl font-extrabold">{{ $company->exists ? 'Edit Perusahaan' : 'Tambah Perusahaan' }}</h1>
        <p class="mt-2 text-sm text-gray-500">Perusahaan baru masuk ke antrian verifikasi sebelum lowongannya dapat diterbitkan.</p>

        <form action="{{ $company->exists ? route('admin.companies.update', $company) : route('admin.companies.store') }}"
            method="POST" enctype="multipart/form-data" class="mt-7 space-y-5 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @if ($company->exists)
                @method('PUT')
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <label class="block text-xs font-semibold">Nama Perusahaan
                    <input name="name" value="{{ old('name', $company->name) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal outline-none focus:border-[#151442]">
                </label>
                <label class="block text-xs font-semibold">Slug
                    <input name="slug" value="{{ old('slug', $company->slug) }}" required maxlength="255" pattern="[A-Za-z0-9_-]+" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal outline-none focus:border-[#151442]">
                </label>
                <label class="block text-xs font-semibold">Nama Badan Usaha
                    <input name="legal_name" value="{{ old('legal_name', $company->legal_name) }}" maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal outline-none focus:border-[#151442]">
                </label>
                <label class="block text-xs font-semibold">Wilayah
                    <input name="region" value="{{ old('region', $company->region) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal outline-none focus:border-[#151442]">
                </label>
                <label class="block text-xs font-semibold">Nama Pemilik
                    <input name="owner_name" value="{{ old('owner_name', $company->owner_name) }}" maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal outline-none focus:border-[#151442]">
                </label>
                <label class="block text-xs font-semibold">Jumlah Outlet
                    <input name="outlets_count" type="number" min="1" value="{{ old('outlets_count', $company->outlets_count ?: 1) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal outline-none focus:border-[#151442]">
                </label>
            </div>

            <label class="block text-xs font-semibold">Logo Perusahaan (JPG, PNG, WEBP; maks. 2 MB)
                <input name="logo" type="file" accept=".jpg,.jpeg,.png,.webp" class="mt-2 block w-full text-sm text-gray-600 file:mr-3 file:rounded-full file:border-0 file:bg-[#151442] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white">
            </label>
            @if ($company->logo_url)
                <img src="{{ $company->logo_url }}" alt="Logo saat ini" class="h-20 w-20 rounded-lg border border-gray-100 object-contain p-2">
            @endif

            <button type="submit" class="rounded-full bg-[#151442] px-6 py-3 text-sm font-semibold text-white hover:bg-[#25236b]">
                {{ $company->exists ? 'Simpan Perubahan' : 'Simpan Perusahaan' }}
            </button>
        </form>
    </div>
@endsection
