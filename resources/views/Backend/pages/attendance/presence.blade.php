@extends('backend.main')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-orange-600 text-[10px] font-bold uppercase tracking-[0.2em] mb-4 border border-orange-100">
            <i data-lucide="zap" class="w-3 h-3 text-orange-500"></i>
            Member Dashboard
        </div>
        <!-- <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-2">Presensi <span class="text-orange-600">Mandiri</span></h1>
        <p class="text-gray-500 font-medium text-lg max-w-xl">Kelola kehadiran dan pantau riwayat kegiatan anda.</p> -->
    </div>

    <!-- Top Info Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card 1: User Profile -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl shadow-orange-900/5 flex items-center gap-4 transition-all hover:border-orange-200">
            <div class="w-14 h-14 rounded-xl bg-orange-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-orange-200 shrink-0">
                {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Nama Anggota</p>
                <h3 class="font-semibold text-gray-900 truncate">{{ auth()->user()->full_name ?? auth()->user()->name }}</h3>
            </div>
        </div>

        <!-- Card 2: Organisation -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl shadow-orange-900/5 flex items-center gap-4 transition-all hover:border-orange-200">
            <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                <i data-lucide="puzzle" class="w-7 h-7"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Ekstrakurikuler</p>
                <h3 class="font-semibold text-gray-900 truncate">{{ auth()->user()->organisation->name ?? 'No Ekskul' }}</h3>
            </div>
        </div>

        <!-- Card 3: Division -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl shadow-orange-900/5 flex items-center gap-4 transition-all hover:border-orange-200">
            <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 shrink-0">
                <i data-lucide="layers" class="w-7 h-7"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Divisi</p>
                <h3 class="font-semibold text-gray-900 truncate">{{ auth()->user()->division->name ?? 'N/A' }}</h3>
            </div>
        </div>

        <!-- Card 4: Role -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl shadow-orange-900/5 flex items-center gap-4 transition-all hover:border-orange-200">
            <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-green-600 shrink-0">
                <i data-lucide="shield" class="w-7 h-7"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Otoritas</p>
                <h3 class="font-semibold text-gray-900 truncate uppercase">{{ auth()->user()->role }}</h3>
            </div>
        </div>
    </div>

    <!-- Active Sessions & Main Actions -->
    <div class="space-y-6 mb-12">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i data-lucide="calendar-days" class="w-5 h-5 text-orange-600"></i>
                Sesi Berjalan
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($sessions as $session)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-orange-900/5 overflow-hidden transition-all hover:border-orange-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}
                        </span>
                        <div class="flex items-center gap-1.5 text-xs font-bold text-orange-600">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                            {{ $session->start_time ?? '--:--' }} - {{ $session->end_time ?? '--:--' }}
                        </div>
                    </div>

                    <h2 class="text-lg font-bold text-gray-900 mb-6 leading-tight truncate">{{ $session->title }}</h2>

                    @php 
                        $att = $attendances->get($session->id);
                        $currentTime = now()->format('H:i:s');
                        $isExpired = $session->end_time && $currentTime > $session->end_time;
                        $isStarted = !$session->start_time || $currentTime >= $session->start_time;
                    @endphp

                    @if($att && $att->status === 'hadir')
                    <div class="bg-green-50 border border-green-100 rounded-xl p-4 flex items-center justify-between">
                        <div>
                            <p class="text-green-800 font-bold text-xs uppercase tracking-wider">Hadir</p>
                            <p class="text-[10px] text-green-600 font-medium italic">{{ \Carbon\Carbon::parse($att->checkin_time)->format('H:i') }} WIB</p>
                        </div>
                        <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500"></i>
                    </div>
                    @elseif(($att && in_array($att->status, ['alpa', 'izin', 'sakit'])) || $isExpired)
                    <div class="bg-red-50 border border-red-100 rounded-xl p-4 flex items-center justify-between">
                        <div>
                            <p class="text-red-800 font-bold text-xs uppercase tracking-wider">
                                {{ $att ? strtoupper($att->status) : 'ALFA' }}
                            </p>
                            <p class="text-[10px] text-red-600 font-medium italic">Sesi telah berakhir</p>
                        </div>
                        <i data-lucide="x-circle" class="w-6 h-6 text-red-500"></i>
                    </div>
                    @elseif(!$isStarted)
                    <div class="w-full bg-gray-50 border border-gray-200 text-gray-400 font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 text-sm cursor-not-allowed">
                        <i data-lucide="timer" class="w-4 h-4"></i>
                        <span>Sesi Belum Dimulai</span>
                    </div>
                    @else
                    <form action="{{ route('member.attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="session_id" value="{{ $session->id }}">
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">

                        <button type="submit" onclick="requestLocation()" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-200 transition-all active:scale-[0.98] transform flex items-center justify-center gap-2 text-sm group">
                            <span>Klaim Kehadiran</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="md:col-span-2 lg:col-span-3 bg-gray-50/50 rounded-2xl border-2 border-dashed border-gray-200 py-10 text-center">
                <p class="text-sm font-bold text-gray-400">Belum ada sesi aktif untuk diikuti sekarang.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Full-width History Section (As per sketch) -->
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i data-lucide="history" class="w-5 h-5 text-orange-600"></i>
                Riwayat Absen
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-2xl shadow-orange-900/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Judul Sesi</th>
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Ekstrakurikuler</th>
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Tanggal & Waktu</th>
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($history as $record)
                        <tr class="group hover:bg-orange-50/30 transition-colors">
                            <td class="px-8 py-5">
                                <p class="text-sm font-semibold text-gray-900 truncate max-w-[200px]">{{ $record->session->title ?? 'Sesi Terhapus' }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex px-2.5 py-0.5 rounded-md bg-gray-100 text-[10px] font-bold text-gray-500 uppercase tracking-tighter">
                                    {{ $record->session->organisation->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-[11px] font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($record->session->session_date)->format('d M Y') }}
                                </p>
                                <p class="text-[10px] text-gray-400 font-medium tracking-tight">
                                    Pukul {{ \Carbon\Carbon::parse($record->checkin_time)->format('H:i') }} WIB
                                </p>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $record->status === 'hadir' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                                    @if($record->status === 'hadir')
                                    <i data-lucide="check-circle-2" class="w-3 h-3"></i>
                                    @endif
                                    {{ $record->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center">
                                <p class="text-sm font-bold text-gray-400">Belum ada catatan riwayat absensi.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-4 bg-gray-50/30 border-t border-gray-50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Daftar 10 Aktivitas Terakhir</p>
            </div>
        </div>
    </div>
</div>

<script>
    function requestLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('lng').value = position.coords.longitude;
            });
        }
    }
</script>
@endsection