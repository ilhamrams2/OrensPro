@extends('backend.main')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('divisions.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:text-orange-600 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ isset($division) ? 'Edit' : 'Tambah' }} Divisi</h1>
    </div>
    <p class="text-sm text-gray-500 ml-12">Isi formulir di bawah ini untuk mengelola data divisi.</p>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <form action="{{ isset($division) ? route('divisions.update', $division) : route('divisions.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @if(isset($division))
                @method('PUT')
            @endif

            <div class="space-y-2">
                <label for="organisation_id" class="text-sm font-semibold text-gray-700">Pilih Organisasi</label>
                <select name="organisation_id" id="organisation_id" required
                    class="tom-select w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                    <option value="" disabled selected>Pilih Organisasi...</option>
                    @foreach($organisations as $org)
                        <option value="{{ $org->id }}" {{ old('organisation_id', $division->organisation_id ?? '') == $org->id ? 'selected' : '' }}>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
                @error('organisation_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-gray-700">Nama Divisi</label>
                <input type="text" name="name" id="name" value="{{ old('name', $division->name ?? '') }}" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all"
                    placeholder="Masukkan nama divisi">
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="description" class="text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all"
                    placeholder="Masukkan deskripsi divisi">{{ old('description', $division->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('divisions.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
