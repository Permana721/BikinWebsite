<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 dark:bg-slate-900/70 border-b border-white/20 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <a href="/user/dashboard" class="text-2xl font-extrabold tracking-tighter text-blue-600 dark:text-blue-500 flex items-center gap-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
            WEB-UKM
        </a>
        
        <nav class="hidden md:flex space-x-8 items-center">
            <a href="{{ Auth::check() ? route('user.dashboard') : route('user.home') }}" 
            class="text-sm transition-colors {{ request()->routeIs('user.home', 'user.dashboard') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                {{ Auth::check() ? 'Dashboard' : 'Home' }}
            </a>

            <a href="{{ Auth::check() ? route('user.dashboard') . '#katalog' : route('user.home') . '#templates' }}" 
            class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Templates
            </a>

            <a href="{{ route('user.home') }}#contact" 
            class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Contact
            </a>
        </nav>
        
        <div>
            @auth
                <div class="flex items-center gap-4">
                    <span class="hidden md:block text-sm font-medium text-slate-600 dark:text-slate-300">
                        Halo, <span class="font-bold text-blue-600 dark:text-blue-400">{{ Auth::user()->name }}</span>
                    </span>
                    
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.home') : route('user.profile') }}" 
                        class="text-sm font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 px-4 py-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors shadow-sm">
                        {{ Auth::user()->role === 'admin' ? 'Halaman Admin' : 'Profil Saya' }}
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline m-0 p-0">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                            Keluar
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 mr-6 transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5">Daftar</a>
            @endauth
        </div>
    </div>
</header>