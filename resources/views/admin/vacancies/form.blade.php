@extends('layouts.admin')

@section('title', $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan')

@section('content')
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('admin.vacancies.index') }}" class="text-xs font-semibold text-gray-500">← Kembali ke lowongan</a>
        <h1 class="mt-3 text-3xl font-extrabold">{{ $vacancy->exists ? 'Edit Lowongan' : 'Tambah Lowongan' }}</h1>
        <form action="{{ $vacancy->exists ? route('admin.vacancies.update', $vacancy) : route('admin.vacancies.store') }}" method="POST" enctype="multipart/form-data" class="mt-7 space-y-5 rounded-2xl bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @if ($vacancy->exists)
                @method('PUT')
            @endif
            <label class="block text-xs font-semibold">Perusahaan
                <select name="company_id" required class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @selected(old('company_id', $vacancy->company_id) == $company->id)>{{ $company->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block text-xs font-semibold">Gambar Lowongan (JPG, PNG, WEBP; maks. 4 MB){{ $vacancy->exists ? '' : ' — wajib' }}
                <input name="image" type="file" accept=".jpg,.jpeg,.png,.webp" @required(!$vacancy->exists) class="mt-2 block w-full text-sm text-gray-600 file:mr-3 file:rounded-full file:border-0 file:bg-[#151442] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white">
            </label>
            @if ($vacancy->image_path)
                <img src="{{ $vacancy->image_url }}" alt="Gambar lowongan saat ini" class="h-40 w-full rounded-xl object-contain">
            @endif
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="text-xs font-semibold">Judul<input name="title" value="{{ old('title', $vacancy->title) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Posisi<input name="position" value="{{ old('position', $vacancy->position) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Jenis
                    <select name="employment_type" class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                        @foreach (['Part time', 'Full time'] as $type)<option @selected(old('employment_type', $vacancy->employment_type) === $type)>{{ $type }}</option>@endforeach
                    </select>
                </label>
                <label class="text-xs font-semibold">Kategori<input name="category" value="{{ old('category', $vacancy->category) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Pendidikan minimum<input name="minimum_education" value="{{ old('minimum_education', $vacancy->minimum_education) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Umur maksimum<input name="maximum_age" type="number" min="15" max="100" value="{{ old('maximum_age', $vacancy->maximum_age ?: 35) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Jumlah kebutuhan<input name="needed" type="number" min="1" value="{{ old('needed', $vacancy->needed ?: 1) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Kuota pelamar<input name="quota" type="number" min="1" value="{{ old('quota', $vacancy->quota ?: 10) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Lokasi<input name="location" value="{{ old('location', $vacancy->location) }}" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Alamat<input name="address" value="{{ old('address', $vacancy->address) }}" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Batas lamaran<input name="expires_at" type="date" min="{{ today()->toDateString() }}" value="{{ old('expires_at', $vacancy->expires_at?->toDateString()) }}" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal"></label>
                <label class="text-xs font-semibold">Status
                    <select name="status" class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                        <option value="draft" @selected(old('status', $vacancy->status ?: 'published') === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $vacancy->status ?: 'published') === 'published')>Terbit</option>
                    </select>
                </label>
            </div>
            <label class="block text-xs font-semibold">Deskripsi<textarea name="description" rows="5" required class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">{{ old('description', $vacancy->description) }}</textarea></label>
            @foreach (['responsibilities' => 'Tanggung jawab', 'qualifications' => 'Kualifikasi', 'schedule' => 'Jadwal', 'benefits' => 'Benefit'] as $field => $label)
                <label class="block text-xs font-semibold">{{ $label }} (satu per baris)<textarea name="{{ $field }}" rows="3" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">{{ old($field, implode("\n", $vacancy->{$field} ?? [])) }}</textarea></label>
            @endforeach
            <button type="submit" class="rounded-full bg-[#151442] px-6 py-3 text-sm font-semibold text-white">Simpan Lowongan</button>
        </form>
    </div>
@endsection
