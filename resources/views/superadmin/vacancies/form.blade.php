@extends('layouts.superadmin')

@section('title', $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan')

@section('content')
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('superadmin.vacancies.index') }}" class="text-xs font-semibold text-gray-500 hover:text-[#151442]">← Kembali ke lowongan</a>
        <h1 class="mt-3 text-3xl font-extrabold">{{ $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan' }}</h1>
        <p class="mt-2 text-sm text-gray-500">Pilih perusahaan database untuk menghubungkan lowongan dengan company_id.</p>

        <form action="{{ $vacancy->exists ? route('superadmin.vacancies.update', $vacancy) : route('superadmin.vacancies.store') }}"
            method="POST" class="mt-7 space-y-6 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @if ($vacancy->exists)
                @method('PUT')
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <label class="block text-xs font-semibold sm:col-span-2">Perusahaan
                    <select name="company_id" required class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                        <option value="">Pilih perusahaan</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" @selected(old('company_id', $vacancy->company_id) == $company->id)>
                                {{ $company->name }} · {{ ucfirst($company->verification_status) }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-xs font-semibold sm:col-span-2">Gambar Lowongan (JPG, PNG, WEBP; maks. 4 MB){{ $vacancy->exists ? '' : ' — wajib' }}
                    <input name="image" type="file" accept=".jpg,.jpeg,.png,.webp" @required(!$vacancy->exists) class="mt-2 block w-full text-sm text-gray-600 file:mr-3 file:rounded-full file:border-0 file:bg-[#151442] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white">
                </label>
                @if ($vacancy->image_path)
                    <img src="{{ $vacancy->image_url }}" alt="Gambar lowongan saat ini" class="h-40 w-full rounded-xl object-contain sm:col-span-2">
                @endif
                <label class="block text-xs font-semibold sm:col-span-2">Judul Lowongan
                    <input name="title" value="{{ old('title', $vacancy->title) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Posisi
                    <input name="position" value="{{ old('position', $vacancy->position) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Jenis Pekerjaan
                    <select name="employment_type" required class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                        @foreach (['Part time', 'Full time'] as $type)
                            <option value="{{ $type }}" @selected(old('employment_type', $vacancy->employment_type) === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-xs font-semibold">Kategori
                    <input name="category" value="{{ old('category', $vacancy->category) }}" required maxlength="255" placeholder="Pelayanan, Teknik, Data Analytic..." class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Pendidikan Minimal
                    <input name="minimum_education" value="{{ old('minimum_education', $vacancy->minimum_education) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Umur Maksimal
                    <input name="maximum_age" type="number" min="15" max="100" value="{{ old('maximum_age', $vacancy->maximum_age ?: 35) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Jumlah Dibutuhkan
                    <input name="needed" type="number" min="1" value="{{ old('needed', $vacancy->needed ?: 1) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Kuota Pelamar
                    <input name="quota" type="number" min="1" value="{{ old('quota', $vacancy->quota ?: 10) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Kota / Lokasi
                    <input name="location" value="{{ old('location', $vacancy->location) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Alamat
                    <input name="address" value="{{ old('address', $vacancy->address) }}" maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Batas Lamaran
                    <input name="expires_at" type="date" min="{{ today()->toDateString() }}" value="{{ old('expires_at', $vacancy->expires_at?->toDateString()) }}" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
                </label>
                <label class="block text-xs font-semibold">Status
                    <select name="status" required class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                        <option value="draft" @selected(old('status', $vacancy->status ?: 'draft') === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $vacancy->status) === 'published')>Terbit</option>
                    </select>
                </label>
                <label class="block text-xs font-semibold sm:col-span-2">Deskripsi
                    <textarea name="description" rows="4" required maxlength="10000" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">{{ old('description', $vacancy->description) }}</textarea>
                </label>
                @foreach ([
                    'responsibilities' => 'Tanggung Jawab',
                    'qualifications' => 'Kualifikasi',
                    'schedule' => 'Jadwal Kerja',
                    'benefits' => 'Gaji & Benefit',
                ] as $field => $label)
                    <label class="block text-xs font-semibold">{{ $label }} (satu butir per baris)
                        <textarea name="{{ $field }}" rows="4" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">{{ old($field, implode("\n", $vacancy->{$field} ?? [])) }}</textarea>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="rounded-full bg-[#151442] px-6 py-3 text-sm font-semibold text-white hover:bg-[#25236b]">
                {{ $vacancy->exists ? 'Simpan Perubahan' : 'Simpan Lowongan' }}
            </button>
        </form>
    </div>
@endsection
