<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 dark:bg-slate-900/70 border-b border-white/20 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
        
        <a href="/admin/home" class="text-xl sm:text-2xl font-extrabold tracking-tighter text-blue-600 dark:text-blue-500 flex items-center gap-2">
            <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Admin Panel
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