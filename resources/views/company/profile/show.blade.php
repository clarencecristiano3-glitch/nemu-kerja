@extends('layouts.app')

@section('title', $company->name)

@section('content')
    <section class="mx-auto max-w-4xl px-5 py-10 lg:px-0">
        <a href="{{ route('company.profile.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#151442]">← Kembali ke Perusahaan Saya</a>
        <div class="mt-5 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-[#151442]">{{ $company->name }}</h1>
                    <p class="mt-2 text-sm text-gray-500">{{ $company->legal_name ?: $company->region }} · {{ $company->outlets_count }} outlet</p>
                </div>
                <span class="rounded-full bg-amber-50 px-4 py-2 text-xs font-semibold text-amber-800">
                    {{ ['pending' => 'Menunggu verifikasi', 'verified' => 'Terverifikasi', 'rejected' => 'Ditolak'][$company->status] ?? ucfirst($company->status) }}
                </span>
            </div>
            @if ($company->rejection_reason)
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <h2 class="font-bold">Alasan penolakan</h2>
                    <p class="mt-1">{{ $company->rejection_reason }}</p>
                </div>
            @endif
            @if ($company->document_path)
                <a href="{{ route('company.profile.document', $company) }}" target="_blank" rel="noopener" class="mt-6 inline-flex rounded-full border border-[#151442] px-4 py-2 text-sm font-semibold text-[#151442]">Lihat dokumen tersimpan</a>
            @endif
            @if ($company->status === 'rejected')
                <form action="{{ route('company.profile.reupload', $company) }}" method="POST" enctype="multipart/form-data" class="mt-7 border-t border-gray-100 pt-6">
                    @csrf
                    <label class="block text-xs font-semibold">Unggah dokumen pengganti (PDF/JPG/PNG, maks. 10 MB)
                        <input name="document" type="file" accept=".pdf,.jpg,.jpeg,.png" required class="mt-2 block w-full text-sm text-gray-600">
                    </label>
                    <button type="submit" class="mt-4 rounded-full bg-[#151442] px-5 py-3 text-sm font-semibold text-white">Kirim ulang dokumen</button>
                </form>
            @endif
        </div>
    </section>
@endsection
