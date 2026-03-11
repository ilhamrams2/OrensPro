@extends('backend.main')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Sesi Absensi</h1>
        <p class="text-sm text-gray-500">Kelola jadwal dan sesi absensi ekstrakurikuler.</p>
    </div>
    <a href="{{ route('attendance-sessions.create') }}" class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Buat Sesi Baru
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Sesi</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ekstrakurikuler</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($sessions as $session)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">{{ $session->title }}</div>
                        <div class="text-xs text-gray-400">Dibuat oleh: {{ $session->creator->name ?? 'System' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-orange-100 text-orange-800 uppercase tracking-tighter">
                                {{ $session->organisation->name ?? 'Semua' }}
                            </span>
                            @if($session->division)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800 uppercase tracking-tighter">
                                Divisi: {{ $session->division->name }}
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-800 uppercase tracking-tighter">
                                Semua Divisi
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $session->start_time ?? '--:--' }} - {{ $session->end_time ?? '--:--' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('attendance.marking', $session) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors text-xs">
                                <i data-lucide="check-square" class="w-3.5 h-3.5"></i>
                                Isi Absen
                            </a>
                            <a href="{{ route('attendance-sessions.edit', $session) }}" class="p-2 text-gray-400 hover:text-orange-600 transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('attendance-sessions.destroy', $session) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus sesi absensi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="calendar" class="w-8 h-8 text-gray-300"></i>
                            <p>Belum ada sesi absensi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($sessions->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $sessions->links() }}
    </div>
    @endif
</div>
@endsection
