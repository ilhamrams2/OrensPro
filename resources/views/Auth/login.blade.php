<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | OrensPro - Sistem Absensi Ekskul</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .bg-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#ea580c 0.5px, transparent 0.5px), radial-gradient(#ea580c 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.05;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="max-w-6xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[700px] border border-gray-100">
            
            <!-- (LEFT) Login Form Section -->
            <div class="w-full md:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center relative bg-white">
                <div class="bg-pattern absolute inset-0 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <!-- Brand -->
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-12 h-12 bg-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-200">
                            <i data-lucide="clock" class="text-white w-7 h-7"></i>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-gray-900">Orens<span class="text-orange-600">Pro</span></span>
                    </div>

                    <div class="mb-10">
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-3 tracking-tight">Selamat Datang 👋</h1>
                        <p class="text-gray-500 font-medium">Silakan masuk untuk mengelola absensi ekstrakurikuler sekolah Anda.</p>
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        @if($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6">
                                <div class="flex items-center gap-3">
                                    <i data-lucide="alert-circle" class="text-red-500 w-5 h-5"></i>
                                    <p class="text-red-700 text-sm font-medium">Terjadi kesalahan pada data yang dimasukkan.</p>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-bold text-gray-700 ml-1">Email Sekolah</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-orange-500 transition-colors">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </span>
                                <input type="email" name="email" id="email" required
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all placeholder:text-gray-400"
                                    placeholder="nama@smkprestasiprima.sch.id">
                            </div>
                            @error('email') <p class="text-xs font-medium text-red-500 mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-sm font-bold text-gray-700 ml-1">Kata Sandi</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-orange-500 transition-colors">
                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                </span>
                                <input type="password" name="password" id="password" required
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all placeholder:text-gray-400"
                                    placeholder="••••••••">
                            </div>
                            @error('password') <p class="text-xs font-medium text-red-500 mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between px-1">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" name="remember" class="peer sr-only">
                                    <div class="w-5 h-5 border-2 border-gray-300 rounded-md bg-white peer-checked:bg-orange-600 peer-checked:border-orange-600 transition-all flex items-center justify-center">
                                        <i data-lucide="check" class="text-white w-3 h-3 scale-0 peer-checked:scale-100 transition-transform"></i>
                                    </div>
                                </div>
                                <span class="text-sm font-semibold text-gray-600 group-hover:text-gray-900 transition-colors">Ingat Saya</span>
                            </label>
                            <a href="#" class="text-sm font-bold text-orange-600 hover:text-orange-700 transition-colors">Lupa Password?</a>
                        </div>

                        <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-orange-200 transition-all active:scale-[0.98] transform flex items-center justify-center gap-2 text-lg">
                            <span>Masuk ke Dashboard</span>
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>
                    </form>

                    <div class="mt-12 text-center">
                        <p class="text-gray-500 font-medium">Belum memiliki akses? <a href="#" class="text-orange-600 font-bold hover:underline">Hubungi Admin Sekolah</a></p>
                    </div>
                </div>

                <!-- Footer info -->
                <div class="mt-auto pt-8 flex items-center justify-between text-[10px] text-gray-400 font-bold uppercase tracking-widest relative z-10">
                    <span>&copy; 2026 OrensPro</span>
                    <span>v2.0 Premium Edition</span>
                </div>
            </div>

            <!-- (RIGHT) Illustration Section -->
            <div class="hidden md:flex md:w-1/2 bg-orange-600 relative overflow-hidden items-center justify-center p-12">
                <!-- Abstract Background Shapes -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-orange-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -ml-20 -mb-20"></div>
                
                <div class="relative z-10 w-full max-w-md text-center">
                    <div class="mb-12 animate-float">
                        <div class="relative">
                            <div class="absolute -inset-4 bg-white/20 blur-2xl rounded-full"></div>
                            <img src="{{ asset('brain/cfc623d3-d476-4852-baf0-18d306f56ab0/login_school_illustration_1773192426526.png') }}" 
                                 alt="School Illustration" 
                                 class="relative rounded-[2rem] shadow-2xl border-4 border-white/30 transform rotate-3">
                        </div>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-white mb-4 leading-tight">Membangun Kedisiplinan & Karakter Siswa</h2>
                    <p class="text-orange-100 font-medium opacity-90">Satu sistem terintegrasi untuk mendata kehadiran setiap unit ekstrakurikuler secara real-time dan transparan.</p>
                    
                    <div class="mt-12 flex items-center justify-center gap-6">
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 glass-effect rounded-2xl flex items-center justify-center text-white">
                                <i data-lucide="users" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-bold text-white uppercase tracking-tighter italic">500+ Siswa</span>
                        </div>
                        <div class="w-px h-8 bg-white/20"></div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 glass-effect rounded-2xl flex items-center justify-center text-white">
                                <i data-lucide="shield-check" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-bold text-white uppercase tracking-tighter italic">Cloud Security</span>
                        </div>
                        <div class="w-px h-8 bg-white/20"></div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 glass-effect rounded-2xl flex items-center justify-center text-white">
                                <i data-lucide="zap" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-bold text-white uppercase tracking-tighter italic">Fast Sync</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>
