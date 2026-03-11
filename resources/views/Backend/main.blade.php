<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans text-gray-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white border-r border-gray-200 w-64 flex-shrink-0 flex flex-col transition-all duration-300 lg:translate-x-0 -translate-x-full fixed inset-y-0 left-0 z-40 lg:relative">
            <div class="p-6 flex items-center gap-3">
                <div class="bg-orange-600 p-2 rounded-lg">
                    <i data-lucide="calendar-check" class="text-white w-6 h-6"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-gray-800">AbsenPro</span>
            </div>
            
            <nav class="flex-1 px-4 py-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }} transition-colors">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Dashboard
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('users.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }} transition-colors">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    Manajemen User
                </a>
                <a href="{{ route('organisations.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('organisations.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }} transition-colors">
                    <i data-lucide="building-2" class="w-4 h-4"></i>
                    Manajemen Organisasi
                </a>
                <a href="{{ route('divisions.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('divisions.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }} transition-colors">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                    Manajemen Divisi
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50 hover:text-orange-600 transition-colors">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Kehadiran
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50 hover:text-orange-600 transition-colors">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Laporan
                </a>
                <div class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Sistem
                </div>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50 hover:text-orange-600 transition-colors">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    Pengaturan
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100">
                <div class="bg-gray-50 rounded-xl p-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold">
                        A
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Admin User</p>
                        <p class="text-xs text-gray-500 truncate">admin@absenpro.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 lg:px-8 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button id="toggle-sidebar" class="p-2 rounded-lg hover:bg-gray-100 lg:hidden">
                        <i data-lucide="menu" class="w-6 h-6 text-gray-600"></i>
                    </button>
                    <div class="hidden md:flex items-center gap-2 text-sm text-gray-500">
                        <span>Dashboard</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        <span class="text-gray-900 font-medium">Overview</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button class="p-2 rounded-lg hover:bg-gray-100 relative">
                        <i data-lucide="bell" class="w-5 h-5 text-gray-600"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-orange-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="h-8 w-[1px] bg-gray-200 mx-2"></div>
                    <div class="flex items-center gap-2">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-900 mt-[-2px]">Kamis, 11 Maret</p>
                            <p id="current-time" class="text-xs text-gray-500">07:23 AM</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50/50 p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile sidebar toggle
        const toggleBtn = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }

        // Live clock (simple implementation)
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            if (document.getElementById('current-time')) {
                document.getElementById('current-time').textContent = timeStr;
            }
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>