@extends('backend.main')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('users.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:text-orange-600 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ isset($user) ? 'Edit' : 'Tambah' }} Pengguna</h1>
    </div>
    <p class="text-sm text-gray-500 ml-12">Lengkapi informasi akun dan data profil pengguna.</p>
</div>

<form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST" class="max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-6">
            <h3 class="font-bold text-gray-800 border-b pb-4">Informasi Dasar</h3>
            
            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-gray-700">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                    placeholder="Contoh: jdoe">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="full_name" class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name ?? '') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                    placeholder="Masukkan nama lengkap">
                @error('full_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                    placeholder="email@contoh.com">
                @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="phone" class="text-sm font-semibold text-gray-700">No. Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                    placeholder="08xxxxxxxxxx">
                @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-6">
            <h3 class="font-bold text-gray-800 border-b pb-4">Keamanan</h3>
            <div class="space-y-2">
                <label for="password" class="text-sm font-semibold text-gray-700">
                    Password {{ isset($user) ? '(Kosongkan jika tidak ingin mengubah)' : '' }}
                </label>
                <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }}
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                    placeholder="••••••••">
                @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
                    class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                <label for="is_active" class="text-sm font-medium text-gray-700 leading-none">Pengguna Aktif</label>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-6">
            <h3 class="font-bold text-gray-800 border-b pb-4">Role & Organisasi</h3>
            
            <div class="space-y-2">
                <label for="role" class="text-sm font-semibold text-gray-700">Role</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                    <option value="member" {{ old('role', $user->role ?? '') == 'member' ? 'selected' : '' }}>Member</option>
                    <option value="leader" {{ old('role', $user->role ?? '') == 'leader' ? 'selected' : '' }}>Leader</option>
                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="super_admin" {{ old('role', $user->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="organisation_id" class="text-sm font-semibold text-gray-700">Organisasi</label>
                <select name="organisation_id" id="organisation_id"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                    <option value="">Pilih Organisasi...</option>
                    @foreach($organisations as $org)
                        <option value="{{ $org->id }}" {{ old('organisation_id', $user->organisation_id ?? '') == $org->id ? 'selected' : '' }}>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
                @error('organisation_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="division_id" class="text-sm font-semibold text-gray-700">Divisi</label>
                <select name="division_id" id="division_id"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                    <option value="">Pilih Divisi...</option>
                    @foreach($divisions as $div)
                        <option value="{{ $div->id }}" {{ old('division_id', $user->division_id ?? '') == $div->id ? 'selected' : '' }}>
                            {{ $div->name }} ({{ $div->organisation->name ?? 'No Org' }})
                        </option>
                    @endforeach
                </select>
                @error('division_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg shadow-orange-200 transition-all active:scale-95">
                Simpan Pengguna
            </button>
        </div>
    </div>
</form>
@endsection
