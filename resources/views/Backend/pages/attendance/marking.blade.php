@extends('backend.main')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('attendance-sessions.index') }}" class="p-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Presensi Anggota</h1>
            <p class="text-sm text-gray-500">{{ $session->title }} • {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}</p>
        </div>
    </div>
    
    <div class="flex items-center gap-3 bg-white p-2 rounded-xl border border-gray-200 shadow-sm">
        <div class="px-3 py-1 bg-orange-50 rounded-lg border border-orange-100">
            <span class="text-xs font-bold text-orange-600 uppercase tracking-tighter">Ekskul: {{ $session->organisation->name }}</span>
        </div>
        <div class="h-4 w-px bg-gray-200"></div>
        <div class="flex items-center gap-2 px-2 text-xs font-semibold text-gray-500">
            <i data-lucide="users" class="w-3.5 h-3.5"></i>
            {{ count($members) }} Anggota
        </div>
    </div>
</div>

<form action="{{ route('attendance.mark', $session) }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-orange-900/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Anggota</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($members as $index => $member)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="hidden" name="attendances[{{ $index }}][user_id]" value="{{ $member->id }}">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold border-2 border-white shadow-sm font-sans">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 leading-tight">{{ $member->full_name ?? $member->name }}</div>
                                    <div class="text-xs text-gray-400 font-medium">{{ $member->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                @php
                                    $currentStatus = $attendances->get($member->id)->status ?? 'alpa';
                                @endphp
                                
                                {{-- HADIR --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="attendances[{{ $index }}][status]" value="hadir" 
                                        class="peer sr-only" {{ $currentStatus == 'hadir' ? 'checked' : '' }}>
                                    <div class="px-4 py-2 rounded-xl text-xs font-bold border-2 border-transparent bg-gray-50 text-gray-400 transition-all
                                        peer-checked:bg-green-50 peer-checked:text-green-600 peer-checked:border-green-500 group-hover:bg-gray-100">
                                        HADIR
                                    </div>
                                </label>

                                {{-- SAKIT --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="attendances[{{ $index }}][status]" value="sakit" 
                                        class="peer sr-only" {{ $currentStatus == 'sakit' ? 'checked' : '' }}>
                                    <div class="px-4 py-2 rounded-xl text-xs font-bold border-2 border-transparent bg-gray-50 text-gray-400 transition-all
                                        peer-checked:bg-blue-50 peer-checked:text-blue-600 peer-checked:border-blue-500 group-hover:bg-gray-100">
                                        SAKIT
                                    </div>
                                </label>

                                {{-- IZIN --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="attendances[{{ $index }}][status]" value="izin" 
                                        class="peer sr-only" {{ $currentStatus == 'izin' ? 'checked' : '' }}>
                                    <div class="px-4 py-2 rounded-xl text-xs font-bold border-2 border-transparent bg-gray-50 text-gray-400 transition-all
                                        peer-checked:bg-yellow-50 peer-checked:text-yellow-600 peer-checked:border-yellow-500 group-hover:bg-gray-100">
                                        IZIN
                                    </div>
                                </label>

                                {{-- ALPA --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="attendances[{{ $index }}][status]" value="alpa" 
                                        class="peer sr-only" {{ $currentStatus == 'alpa' ? 'checked' : '' }}>
                                    <div class="px-4 py-2 rounded-xl text-xs font-bold border-2 border-transparent bg-gray-50 text-gray-400 transition-all
                                        peer-checked:bg-red-50 peer-checked:text-red-600 peer-checked:border-red-500 group-hover:bg-gray-100">
                                        ALPA
                                    </div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="user-minus" class="w-8 h-8 text-gray-200"></i>
                                <p class="font-medium">Tidak ada anggota terdaftar di ekskul ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($members) > 0)
        <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
            <p class="text-sm font-medium text-gray-500">Pastikan data sudah benar sebelum menyimpan.</p>
            <button type="submit" class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-orange-200 transition-all active:scale-95">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Kehadiran
            </button>
        </div>
        @endif
    </div>
</form>
@endsection
