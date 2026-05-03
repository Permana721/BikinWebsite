<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | BikinSitus</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out forwards; }
    </style>
</head>
<body class="bg-[#FAFAFA] dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col relative overflow-x-hidden transition-colors duration-300">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none z-0"></div>
    <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none z-0"></div>

    <main class="grow relative z-10 flex flex-col">
        @include('user.layouts.header')

        <div class="max-w-6xl mx-auto px-6 py-12 md:py-20 w-full flex-grow">
            
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">Profil Saya</h1>
                <p class="text-slate-500 dark:text-slate-400">Kelola informasi akun dan lihat riwayat pembelian template kamu.</p>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-400 animate-fade-in">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="w-full md:w-1/3 lg:w-1/4 sticky top-24">
                    <div class="bg-white dark:bg-slate-800/50 backdrop-blur-xl rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm">
                        
                        <div class="flex flex-col items-center text-center mb-8">
                            <div class="w-24 h-24 bg-blue-50 dark:bg-slate-800 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center text-4xl font-extrabold mb-4 border-2 border-blue-100 dark:border-slate-700 shadow-inner">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white">{{ Auth::user()->name ?? 'User UMKM' }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ Auth::user()->email ?? 'user@email.com' }}</p>
                        </div>

                        <div class="flex flex-row md:flex-col gap-2 overflow-x-auto hide-scroll pb-2 md:pb-0">
                            <button id="btn-tab-profile" onclick="switchTab('profile')" class="flex-shrink-0 w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all bg-blue-600 text-white shadow-lg shadow-blue-600/20 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Detail Profil
                            </button>
                            <button id="btn-tab-history" onclick="switchTab('history')" class="flex-shrink-0 w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl font-semibold text-sm transition-all text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-blue-600 dark:hover:text-blue-400 border border-transparent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Riwayat Pembelian
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/3 lg:w-3/4">
                    
                    <div id="content-profile" class="block animate-fade-in">
                        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-6 md:p-10 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-700 pb-4">Pengaturan Akun</h2>
                            
                            <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Nama Bisnis / Lengkap</label>
                                        <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" required 
                                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Email Utama</label>
                                        <input type="email" value="{{ Auth::user()->email ?? '' }}" disabled 
                                                class="w-full px-5 py-4 rounded-2xl bg-slate-100 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 text-slate-500 cursor-not-allowed">
                                        <p class="text-xs text-slate-400 mt-2">*Email terikat dengan akun dan tidak bisa diubah.</p>
                                    </div>

                                    <div class="md:col-span-2 mt-4">
                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white border-t border-slate-100 dark:border-slate-700 pt-6 mb-2">Ubah Kata Sandi</h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Kosongkan jika tidak ingin mengubah kata sandi.</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Kata Sandi Baru</label>
                                        <input type="password" name="password" placeholder="••••••••" 
                                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                        @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Ulangi Kata Sandi Baru</label>
                                        <input type="password" name="password_confirmation" placeholder="••••••••" 
                                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                    </div>
                                </div>

                                <div class="pt-8">
                                    <button type="submit" class="w-full md:w-auto px-10 py-4 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 shadow-xl shadow-blue-600/30 transition-all transform hover:-translate-y-1">
                                        Simpan Perubahan Profil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="content-history" class="hidden animate-fade-in">
                        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-6 md:p-10 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-700 pb-4">Riwayat Template Saya</h2>
                            
                            @if(isset($orders) && count($orders) > 0)
                                <div class="space-y-4">
                                    @foreach($orders as $order)
                                        <div class="p-5 md:p-6 rounded-2xl bg-[#FAFAFA] dark:bg-slate-900 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-700 transition-colors flex flex-col md:flex-row md:items-center justify-between gap-4">
                                            <div>
                                                <div class="flex items-center gap-3 mb-2">
                                                    <span class="text-xs font-extrabold text-slate-500">{{ $order->id }}</span>
                                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] font-extrabold rounded-full tracking-wider uppercase">Berhasil</span>
                                                </div>
                                                <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-1">{{ $order->template_name }}</h4>
                                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $order->date }}</p>
                                            </div>
                                            <div class="flex flex-row md:flex-col items-center md:items-end justify-between border-t md:border-t-0 border-slate-200 dark:border-slate-700 pt-4 md:pt-0">
                                                <span class="font-extrabold text-xl text-slate-900 dark:text-white mb-2">{{ $order->total }}</span>
                                                <a href="#" class="px-5 py-2.5 bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-slate-600 rounded-xl text-sm font-bold hover:bg-blue-50 dark:hover:bg-slate-700 transition-colors flex items-center gap-2 shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                    Unduh File
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-16 px-4">
                                    <div class="w-24 h-24 bg-slate-50 dark:bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada template</h3>
                                    <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-sm mx-auto">Kamu belum pernah membeli atau mendownload template premium apapun.</p>
                                    <a href="{{ url('/#templates') }}" class="px-8 py-4 bg-blue-600 text-white rounded-full font-bold shadow-xl shadow-blue-600/30 hover:bg-blue-700 hover:-translate-y-1 transition-all inline-block">
                                        Mulai Eksplorasi Template
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('user.layouts.footer')
    </main>

    <script>
        function switchTab(tabName) {
            document.getElementById('content-profile').classList.add('hidden');
            document.getElementById('content-profile').classList.remove('block');
            document.getElementById('content-history').classList.add('hidden');
            document.getElementById('content-history').classList.remove('block');

            let btnProfile = document.getElementById('btn-tab-profile');
            let btnHistory = document.getElementById('btn-tab-history');

            const inactiveClasses = ['text-slate-600', 'dark:text-slate-400', 'hover:bg-slate-50', 'dark:hover:bg-slate-700', 'hover:text-blue-600', 'dark:hover:text-blue-400', 'border-transparent'];
            const activeClasses = ['bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-600/20', 'transform', 'hover:-translate-y-0.5'];

            btnProfile.classList.remove(...activeClasses);
            btnProfile.classList.add(...inactiveClasses);
            
            btnHistory.classList.remove(...activeClasses);
            btnHistory.classList.add(...inactiveClasses);

            if (tabName === 'profile') {
                document.getElementById('content-profile').classList.remove('hidden');
                document.getElementById('content-profile').classList.add('block');
                btnProfile.classList.remove(...inactiveClasses);
                btnProfile.classList.add(...activeClasses);
            } else if (tabName === 'history') {
                document.getElementById('content-history').classList.remove('hidden');
                document.getElementById('content-history').classList.add('block');
                btnHistory.classList.remove(...inactiveClasses);
                btnHistory.classList.add(...activeClasses);
            }
        }
    </script>
</body>
</html>