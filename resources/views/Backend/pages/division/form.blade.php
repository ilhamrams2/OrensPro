@extends('backend.main')

@section('content')
<div class="mb-10">
    <div class="flex items-center gap-4 mb-3">
        <a href="{{ route('divisions.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl text-gray-400 hover:text-orange-600 hover:border-orange-200 hover:bg-orange-50 transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ isset($division) ? 'Edit' : 'Tambah' }} Divisi</h1>
            <p class="text-sm text-gray-500 font-medium italic">Kelola subunit atau divisi dalam sebuah ekstrakurikuler.</p>
        </div>
    </div>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 overflow-hidden">
        <div class="bg-gradient-to-r from-orange-50 to-white px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="p-2 bg-orange-600 rounded-lg shadow-lg shadow-orange-200">
                <i data-lucide="layers" class="w-4 h-4 text-white"></i>
            </div>
            <h3 class="font-bold text-gray-800">Detail Divisi</h3>
        </div>

        <form action="{{ isset($division) ? route('divisions.update', $division) : route('divisions.store') }}" method="POST" class="p-8 space-y-8">
            @csrf
            @if(isset($division))
                @method('PUT')
            @endif

            <div class="space-y-2">
                <label for="organisation_id" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <i data-lucide="puzzle" class="w-4 h-4 text-orange-500"></i>
                    Ekstrakurikuler Utama
                </label>
                <div class="group">
                    <select name="organisation_id" id="organisation_id" required
                        class="tom-select w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                        <option value="" disabled selected>Pilih Ekskul...</option>
                        @foreach($organisations as $org)
                            <option value="{{ $org->id }}" {{ old('organisation_id', $division->organisation_id ?? '') == $org->id ? 'selected' : '' }}>
                                {{ $org->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('organisation_id')
                    <p class="text-xs font-medium text-red-500 mt-1 flex items-center gap-1 italic">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="name" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <i data-lucide="type" class="w-4 h-4 text-orange-500"></i>
                    Nama Divisi
                </label>
                <div class="relative group">
                    <input type="text" name="name" id="name" value="{{ old('name', $division->name ?? '') }}" required
                        class="w-full pl-4 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all group-hover:border-gray-300"
                        placeholder="Contoh: Divisi Frontend / Keamanan">
                </div>
                @error('name')
                    <p class="text-xs font-medium text-red-500 mt-1 flex items-center gap-1 italic">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="description" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <i data-lucide="align-left" class="w-4 h-4 text-orange-500"></i>
                    Deskripsi Divisi
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all group-hover:border-gray-300"
                    placeholder="Apa tanggung jawab divisi ini?">{{ old('description', $division->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-xs font-medium text-red-500 mt-1 flex items-center gap-1 italic">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                <a href="{{ route('divisions.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-all">
                    Batalkan
                </a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-orange-200 transition-all active:scale-95 flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    {{ isset($division) ? 'Simpan Perubahan' : 'Tambah Divisi' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
