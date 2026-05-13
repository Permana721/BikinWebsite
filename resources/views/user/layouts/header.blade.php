<header class="sticky top-0 z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <a href="/user/dashboard" class="text-xl md:text-2xl font-extrabold tracking-tighter text-blue-600 dark:text-blue-500 flex items-center gap-1.5 md:gap-2 shrink-0">
            <img src="{{ asset('assets/img/logo/BikinWebsiteLogo.png') }}" alt="Logo BikinWebsite" class="h-7 w-7 md:h-9 md:w-9 object-contain">
            <span class="hidden sm:inline">Bikin<span class="font-light">Website</span></span>
        </a>
        
        <nav class="hidden md:flex space-x-8 items-center">
            <a href="{{ Auth::check() ? route('user.dashboard') : route('user.home') }}" 
            class="text-sm transition-colors {{ request()->routeIs('user.home', 'user.dashboard') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                {{ Auth::check() ? 'Dashboard' : 'Home' }}
            </a>

            <a href="{{ route('user.templates') }}" 
            class="text-sm font-medium transition-colors {{ request()->routeIs('user.templates') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Templates
            </a>

            <a href="{{ route('user.help') }}" 
            class="text-sm font-medium transition-colors {{ request()->routeIs('user.help') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Help Center
            </a>
        </nav>
        
        <div class="flex items-center gap-2 sm:gap-3">
            @auth
                <div class="flex items-center gap-2 sm:gap-3">
                    <span class="hidden md:block text-sm font-medium text-slate-600 dark:text-slate-300">
                        Halo, <span class="font-bold text-blue-600 dark:text-blue-400">{{ Auth::user()->name }}</span>
                    </span>
                    
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.profile') }}" 
                        class="text-xs md:text-sm font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 px-3 md:px-4 py-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors shadow-sm whitespace-nowrap flex items-center gap-1.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="hidden sm:inline">{{ Auth::user()->role === 'admin' ? 'Dashboard Admin' : 'Profil Saya' }}</span>
                        <span class="sm:hidden">{{ Auth::user()->role === 'admin' ? 'Admin' : 'Profil' }}</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline m-0 p-0">
                        @csrf
                        <button type="submit" class="text-xs md:text-sm font-bold text-red-500 hover:text-red-600 dark:hover:text-red-400 transition-colors whitespace-nowrap">
                            Keluar
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 mr-2 md:mr-6 transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold bg-blue-600 text-white px-4 md:px-5 py-2 md:py-2.5 rounded-full hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5">Daftar</a>
            @endauth

            <button id="mobile-menu-btn" class="md:hidden p-1.5 ml-1 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-t border-slate-100 dark:border-slate-800 absolute w-full left-0 shadow-lg">
        <nav class="flex flex-col px-6 py-4 space-y-4">
            <a href="{{ Auth::check() ? route('user.dashboard') : route('user.home') }}" 
            class="text-sm transition-colors {{ request()->routeIs('user.home', 'user.dashboard') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                {{ Auth::check() ? 'Dashboard' : 'Home' }}
            </a>
            <a href="{{ route('user.templates') }}" 
            class="text-sm font-medium transition-colors {{ request()->routeIs('user.templates') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Templates
            </a>
            <a href="{{ route('user.help') }}" 
            class="text-sm font-medium transition-colors {{ request()->routeIs('user.help') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Help Center
            </a>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if(btn && menu) {
                btn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</header>