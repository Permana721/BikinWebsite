<header class="fixed top-0 left-0 right-0 z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
        <a href="/admin/dashboard" class="text-xl sm:text-2xl font-extrabold tracking-tighter text-blue-600 dark:text-blue-500 flex items-center gap-2">
            <img src="{{ asset('assets/img/logo/BikinWebsiteAdminLogo.png') }}" alt="Logo BikinWebsite" class="h-8 w-auto">
            <span>Admin Panel</span>
        </a>
        
        <nav class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('admin.dashboard') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Home
            </a>

            <a href="{{ route('admin.templates.index') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.templates*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Template
            </a>

            <a href="{{ route('admin.categories.index') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.categories*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Kategori
            </a>

            <a href="{{ route('admin.user') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.user*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                User
            </a>

            <a href="{{ route('admin.hosted-websites') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.hosted-websites*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Hosting
            </a>

            <a href="{{ route('user.dashboard') }}" 
            class="text-sm transition-colors {{ request()->routeIs('user.dashboard*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Dashboard User
            </a>
        </nav>
        
        <div>
            <div class="flex items-center gap-2 sm:gap-4">
                <span class="hidden sm:block text-sm font-medium text-slate-600 dark:text-slate-300">
                    Halo, <span class="font-bold text-blue-600 dark:text-blue-400">{{ Auth::user()->name ?? 'Administrator' }}</span>
                </span>
                
                <form action="{{ route('logout') }}" method="POST" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" class="text-xs sm:text-sm font-bold bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 px-4 py-2 rounded-full hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors shadow-sm">
                        Keluar
                    </button>
                </form>
                
                <button id="admin-mobile-menu-btn" aria-label="Toggle menu" class="md:hidden p-1.5 ml-1 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="admin-mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-t border-slate-100 dark:border-slate-800 absolute w-full left-0 shadow-lg">
        <nav class="flex flex-col px-6 py-4 space-y-4">
            <a href="{{ route('admin.dashboard') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Home
            </a>
            <a href="{{ route('admin.templates.index') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.templates*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Template
            </a>
            <a href="{{ route('admin.categories.index') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.categories*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Kategori
            </a>
            <a href="{{ route('admin.user') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.user*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                User
            </a>
            <a href="{{ route('admin.hosted-websites') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.hosted-websites*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Hosting
            </a>
            <a href="{{ route('user.dashboard') }}" 
            class="text-sm transition-colors {{ request()->routeIs('user.dashboard*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600' }}">
                Dashboard User
            </a>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('admin-mobile-menu-btn');
            const menu = document.getElementById('admin-mobile-menu');
            if(btn && menu) {
                btn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</header>