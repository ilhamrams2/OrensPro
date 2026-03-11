@extends('backend.main')

@section('content')
<div class="mb-10">
    <div class="flex items-center gap-4 mb-3">
        <a href="{{ route('users.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl text-gray-400 hover:text-orange-600 hover:border-orange-200 hover:bg-orange-50 transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ isset($user) ? 'Edit' : 'Tambah' }} Anggota</h1>
            <p class="text-sm text-gray-500 font-medium italic">Kelola profil, level, dan akses keamanan anggota ekskul.</p>
        </div>
    </div>
</div>

<form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST" class="max-w-5xl mx-auto">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column: Personal Info & Security -->
        <div class="lg:col-span-7 space-y-8">
            <!-- Personal Info Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-white px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="p-2 bg-orange-600 rounded-lg shadow-lg shadow-orange-200">
                        <i data-lucide="user" class="w-4 h-4 text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Informasi Pribadi</h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="space-y-2">
                        <label for="full_name" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                            <i data-lucide="user-check" class="w-4 h-4 text-orange-500"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name ?? '') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all"
                            placeholder="Contoh: Ahmad Subagja">
                        @error('full_name') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="email" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                                <i data-lucide="mail" class="w-4 h-4 text-orange-500"></i>
                                Email Utama
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all"
                                placeholder="email@domain.com">
                            @error('email') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                                <i data-lucide="phone" class="w-4 h-4 text-orange-500"></i>
                                No. Telepon
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all"
                                placeholder="08123456789">
                            @error('phone') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-white px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="p-2 bg-orange-600 rounded-lg shadow-lg shadow-orange-200">
                        <i data-lucide="lock" class="w-4 h-4 text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Keamanan Akun</h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="space-y-2">
                        <label for="password" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                            <i data-lucide="key" class="w-4 h-4 text-orange-500"></i>
                            Kata Sandi {{ isset($user) ? '(Kosongkan jika tetap)' : '' }}
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }}
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all"
                                placeholder="••••••••">
                        </div>
                        @error('password') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Role & Organization -->
        <div class="lg:col-span-5 space-y-8">
            <!-- Placement Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-white px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="p-2 bg-orange-600 rounded-lg shadow-lg shadow-orange-200">
                        <i data-lucide="shield" class="w-4 h-4 text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Akses & Unit</h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="space-y-2">
                        <label for="role" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                            <i data-lucide="user-cog" class="w-4 h-4 text-orange-500"></i>
                            Level Akses (Role)
                        </label>
                        <select name="role" id="role" required
                            class="tom-select w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                            <option value="member" {{ old('role', $user->role ?? '') == 'member' ? 'selected' : '' }}>Anggota</option>
                            <option value="leader" {{ old('role', $user->role ?? '') == 'leader' ? 'selected' : '' }}>Ketua Divisi / Ekskul</option>
                            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Pembina / Staf</option>
                            <option value="super_admin" {{ old('role', $user->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @error('role') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="organisation_id" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                            <i data-lucide="puzzle" class="w-4 h-4 text-orange-500"></i>
                            Ekstrakurikuler
                        </label>
                        <select name="organisation_id" id="organisation_id"
                            class="tom-select w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                            <option value="">Pilih Ekskul...</option>
                            @foreach($organisations as $org)
                                <option value="{{ $org->id }}" {{ old('organisation_id', $user->organisation_id ?? '') == $org->id ? 'selected' : '' }}>
                                    {{ $org->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('organisation_id') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="division_id" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                            <i data-lucide="layers" class="w-4 h-4 text-orange-500"></i>
                            Divisi
                        </label>
                        <select name="division_id" id="division_id"
                            class="tom-select w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                            <option value="">Pilih Divisi...</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div->id }}" {{ old('division_id', $user->division_id ?? '') == $div->id ? 'selected' : '' }}>
                                    {{ $div->name }} ({{ $div->organisation->name ?? 'Independen' }})
                                </option>
                            @endforeach
                        </select>
                        @error('division_id') <p class="text-xs font-medium text-red-500 italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 px-4 py-3 bg-orange-50 rounded-xl border border-orange-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-600 rounded-lg">
                                <i data-lucide="power" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800 leading-none">Status Akun</p>
                                <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-wider font-bold">Aktif / Nonaktif</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 space-y-4">
                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg shadow-orange-200 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                    {{ isset($user) ? 'Perbarui Data Anggota' : 'Daftarkan Anggota Baru' }}
                </button>
                <a href="{{ route('users.index') }}" class="w-full flex items-center justify-center px-8 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-all">
                    Batalkan & Kembali
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
