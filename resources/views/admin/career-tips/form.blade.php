@extends('layouts.admin')

@section('title', $careerTip->exists ? 'Edit Tips Karier' : 'Tambah Tips Karier')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('admin.career-tips.index') }}" class="text-xs font-semibold text-gray-500 hover:text-[#151442]">← Kembali ke tips</a>
        <h1 class="mt-3 text-3xl font-extrabold">{{ $careerTip->exists ? 'Edit Tips Karier' : 'Tambah Tips Karier' }}</h1>

        <form action="{{ $careerTip->exists ? route('admin.career-tips.update', $careerTip) : route('admin.career-tips.store') }}"
            method="POST" enctype="multipart/form-data" class="mt-7 space-y-5 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @if ($careerTip->exists)
                @method('PUT')
            @endif

            <label class="block text-xs font-semibold">Judul
                <input name="title" value="{{ old('title', $careerTip->title) }}" required maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
            </label>
            <label class="block text-xs font-semibold">Sumber
                <input name="source" value="{{ old('source', $careerTip->source) }}" maxlength="255" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">
            </label>
            <label class="block text-xs font-semibold">Ringkasan
                <textarea name="summary" rows="3" required maxlength="1000" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">{{ old('summary', $careerTip->summary) }}</textarea>
            </label>
            <label class="block text-xs font-semibold">Isi Tips
                <textarea name="body" rows="10" required maxlength="50000" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-normal">{{ old('body', $careerTip->body) }}</textarea>
            </label>
            <label class="block text-xs font-semibold">Gambar (JPG, PNG, WEBP; maks. 4 MB)
                <input name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="mt-2 block w-full text-sm text-gray-600 file:mr-3 file:rounded-full file:border-0 file:bg-[#151442] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white">
            </label>
            @if ($careerTip->image_path)
                <img src="{{ $careerTip->image_url }}" alt="Gambar tips saat ini" class="h-32 rounded-xl object-cover">
            @endif
            <label class="block text-xs font-semibold">Status
                <select name="status" required class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-normal">
                    <option value="draft" @selected(old('status', $careerTip->status ?: 'draft') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $careerTip->status) === 'published')>Terbit</option>
                </select>
            </label>

            <button type="submit" class="rounded-full bg-[#151442] px-6 py-3 text-sm font-semibold text-white hover:bg-[#25236b]">
                {{ $careerTip->exists ? 'Simpan Perubahan' : 'Simpan Tips' }}
            </button>
        </form>
    </div>
@endsection
