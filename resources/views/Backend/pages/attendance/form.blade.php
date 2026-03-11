@extends('backend.main')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('attendance-sessions.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ isset($session) ? 'Edit' : 'Tambah' }} Sesi Absensi</h1>
            <p class="text-sm text-gray-500">Tentukan jadwal kegiatan ekstrakurikuler.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 overflow-hidden">
        <div class="bg-gradient-to-r from-orange-50 to-white px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="p-2 bg-orange-600 rounded-lg shadow-lg shadow-orange-200">
                <i data-lucide="calendar-days" class="w-4 h-4 text-white"></i>
            </div>
            <h3 class="font-bold text-gray-800">Konfigurasi Sesi</h3>
        </div>

        <form action="{{ isset($session) ? route('attendance-sessions.update', $session) : route('attendance-sessions.store') }}" method="POST" class="p-8 space-y-8">
            @csrf
            @if(isset($session)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Judul Sesi -->
                <div class="md:col-span-2 space-y-2">
                    <label for="title" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <i data-lucide="type" class="w-4 h-4 text-orange-500"></i>
                        Judul Sesi
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $session->title ?? '') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all"
                        placeholder="Contoh: Latihan Rutin Mingguan">
                    @error('title') <p class="text-xs font-medium text-red-500 italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Ekstrakurikuler -->
                <div class="space-y-2">
                    <label for="organisation_id" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <i data-lucide="puzzle" class="w-4 h-4 text-orange-500"></i>
                        Pilih Ekstrakurikuler
                    </label>
                    <select name="organisation_id" id="organisation_id" required
                        class="tom-select w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                        <option value="" disabled selected>Pilih Ekskul...</option>
                        @foreach($organisations as $org)
                            <option value="{{ $org->id }}" {{ old('organisation_id', $session->organisation_id ?? '') == $org->id ? 'selected' : '' }}>
                                {{ $org->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Divisi -->
                <div class="space-y-2">
                    <label for="division_id" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <i data-lucide="layers" class="w-4 h-4 text-orange-500"></i>
                        Pilih Divisi (Opsional)
                    </label>
                    <select name="division_id" id="division_id"
                        class="tom-select w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                        <option value="">Semua Divisi</option>
                        @foreach($divisions as $div)
                            <option value="{{ $div->id }}" {{ old('division_id', $session->division_id ?? '') == $div->id ? 'selected' : '' }}>
                                {{ $div->name }} ({{ $div->organisation->name ?? '' }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-gray-400 font-medium italic">Kosongkan jika sesi untuk semua divisi di ekskul ini.</p>
                </div>

                <!-- Tanggal Sesi -->
                <div class="space-y-2">
                    <label for="session_date" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <i data-lucide="calendar" class="w-4 h-4 text-orange-500"></i>
                        Tanggal Sesi
                    </label>
                    <input type="date" name="session_date" id="session_date" value="{{ old('session_date', $session->session_date ?? date('Y-m-d')) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                </div>

                <!-- Waktu Mulai -->
                <div class="space-y-2">
                    <label for="start_time" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <i data-lucide="clock" class="w-4 h-4 text-orange-500"></i>
                        Waktu Mulai
                    </label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $session->start_time ?? '') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                </div>

                <!-- Waktu Selesai -->
                <div class="space-y-2">
                    <label for="end_time" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <i data-lucide="hourglass" class="w-4 h-4 text-orange-500"></i>
                        Waktu Selesai
                    </label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $session->end_time ?? '') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('attendance-sessions.index') }}" class="px-8 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition-all rounded-xl">
                    Batal
                </a>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-orange-200 transition-all active:scale-95 flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    {{ isset($session) ? 'Simpan Perubahan' : 'Buat Sesi' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
