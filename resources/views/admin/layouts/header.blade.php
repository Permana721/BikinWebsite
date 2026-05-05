<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 dark:bg-slate-900/70 border-b border-white/20 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
        
        <a href="/admin/home" class="text-xl sm:text-2xl font-extrabold tracking-tighter text-blue-600 dark:text-blue-500 flex items-center gap-2">
            <img src="{{ asset('assets/img/logo/BikinWebsiteAdminLogo.png') }}" alt="Logo BikinWebsite" class="h-8 w-auto">
            <span>Admin Panel</span>
        </a>
        
        <nav class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('admin.home') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.home') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Home
            </a>

            <a href="{{ route('admin.templates.index') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.templates.*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Template
            </a>

            <a href="{{ route('admin.categories.index') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.categories.*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Kategori
            </a>

            <a href="{{ route('admin.user') }}" 
            class="text-sm transition-colors {{ request()->routeIs('admin.user') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                User
            </a>

            <a href="#" 
            class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                Transaksi
            </a>

            <a href="{{ route('user.dashboard') }}" 
            class="text-sm transition-colors {{ request()->routeIs('user.dashboard.*') ? 'font-bold text-blue-600 dark:text-blue-400' : 'font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                Dashboard User
            </a>
        </nav>
        
        <div>
            <div class="flex items-center gap-4">
                <span class="hidden sm:block text-sm font-medium text-slate-600 dark:text-slate-300">
                    Halo, <span class="font-bold text-blue-600 dark:text-blue-400">{{ Auth::user()->name ?? 'Administrator' }}</span>
                </span>
                
                <form action="{{ route('logout') }}" method="POST" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" class="text-xs sm:text-sm font-bold bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 px-4 py-2 rounded-full hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors shadow-sm">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>