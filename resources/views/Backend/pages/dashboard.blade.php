@extends('Backend.main')

@section('content')
<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Analitik</h1>
            <p class="text-gray-500 text-sm">Selamat datang kembali, Admin! Berikut ringkasan kehadiran hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                <i data-lucide="download" class="w-4 h-4"></i>
                Ekspor Laporan
            </button>
            <button class="inline-flex items-center gap-2 px-4 py-2 bg-orange-600 border border-transparent text-sm font-medium rounded-lg text-white hover:bg-orange-700 transition-all shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Input Manual
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Karyawan -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-sm font-medium text-gray-500">Total Karyawan</h3>
            <p class="text-2xl font-bold text-gray-900 mt-1">124</p>
        </div>

        <!-- Hadir -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-orange-50 text-orange-600 rounded-lg">
                    <i data-lucide="user-check" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-medium text-gray-400 italic">Hari ini</span>
            </div>
            <h3 class="text-sm font-medium text-gray-500">Hadir</h3>
            <p class="text-2xl font-bold text-gray-900 mt-1">118</p>
        </div>

        <!-- Terlambat -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-yellow-50 text-yellow-600 rounded-lg">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-full">Tinggi</span>
            </div>
            <h3 class="text-sm font-medium text-gray-500">Terlambat</h3>
            <p class="text-2xl font-bold text-gray-900 mt-1">4</p>
        </div>

        <!-- Alpa/Izin -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                    <i data-lucide="user-minus" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-medium text-gray-400">Total</span>
            </div>
            <h3 class="text-sm font-medium text-gray-500">Alpa / Izin</h3>
            <p class="text-2xl font-bold text-gray-900 mt-1">2</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Attendance Trend (Line Chart) -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-gray-900">Tren Kehadiran Mingguan</h3>
                <select class="text-sm border-none bg-gray-50 rounded-lg focus:ring-0">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>

        <!-- Daily Status (Doughnut Chart) -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-6">Status Hari Ini</h3>
            <div class="h-64 relative flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-6 space-y-3">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-orange-500"></span>
                        <span class="text-gray-600">Tepat Waktu</span>
                    </div>
                    <span class="font-semibold text-gray-900">92%</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                        <span class="text-gray-600">Terlambat</span>
                    </div>
                    <span class="font-semibold text-gray-900">5%</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-gray-200"></span>
                        <span class="text-gray-600">Absen</span>
                    </div>
                    <span class="font-semibold text-gray-900">3%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Attendance Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Kehadiran Terbaru</h3>
            <a href="#" class="text-sm font-medium text-orange-600 hover:text-orange-700">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Karyawan</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs">
                                    AP
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Andini Putri</p>
                                    <p class="text-xs text-gray-500">UI Designer</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-900">07:55 AM</p>
                            <p class="text-xs text-gray-500">11 Mar 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                Tepat Waktu
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <i data-lucide="map-pin" class="w-3 h-3"></i>
                                Head Office
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-400 hover:text-gray-600">
                                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                                    RS
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Rizky Saputra</p>
                                    <p class="text-xs text-gray-500">Frontend Dev</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-900">08:15 AM</p>
                            <p class="text-xs text-gray-500">11 Mar 2026</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                Terlambat
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <i data-lucide="map-pin" class="w-3 h-3"></i>
                                Remote
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-400 hover:text-gray-600">
                                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attendance Trend Chart
        const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctxAttendance, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Kehadiran',
                    data: [110, 115, 118, 120, 112, 80, 75],
                    borderColor: '#ea580c', // orange-600
                    backgroundColor: 'rgba(234, 88, 12, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#ea580c'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Status Status Doughnut Chart
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Tepat Waktu', 'Terlambat', 'Absen'],
                datasets: [{
                    data: [92, 5, 3],
                    backgroundColor: ['#f97316', '#fbbf24', '#e5e7eb'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection
