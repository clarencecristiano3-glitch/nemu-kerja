@extends('layouts.superadmin')

@section('title', 'Semua Pengguna')

@section('content')
    <h1 class="text-3xl font-extrabold">Semua Pengguna</h1>
    <div class="mt-7 overflow-x-auto rounded-2xl bg-white shadow-sm">
        <table class="w-full min-w-[640px] text-left text-sm">
            <thead class="border-b border-gray-100 text-xs text-gray-500"><tr><th class="p-4">Username</th><th class="p-4">Nama</th><th class="p-4">Role</th><th class="p-4">Perusahaan</th></tr></thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr><td class="p-4 font-semibold">{{ $user->username }}</td><td class="p-4">{{ $user->name }}</td><td class="p-4">{{ $user->role->value }}</td><td class="p-4">{{ $user->companies_count }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $users->links() }}</div>
@endsection
