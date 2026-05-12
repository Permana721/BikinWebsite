<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview - {{ $template->name }}</title>
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo/BikinWebsiteLogo.png')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function setDeviceView(device) {
            const iframe = document.getElementById('preview-iframe');
            const desktopBtn = document.getElementById('desktop-btn');
            const mobileBtn = document.getElementById('mobile-btn');
            
            if (device === 'mobile') {
                iframe.style.width = '375px';
                mobileBtn.className = 'px-4 py-2 rounded-full bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-sm transition-all text-sm font-bold flex items-center gap-2';
                desktopBtn.className = 'px-4 py-2 rounded-full text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-all text-sm font-medium flex items-center gap-2';
            } else {
                iframe.style.width = '100%';
                desktopBtn.className = 'px-4 py-2 rounded-full bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-sm transition-all text-sm font-bold flex items-center gap-2';
                mobileBtn.className = 'px-4 py-2 rounded-full text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-all text-sm font-medium flex items-center gap-2';
            }
        }
    </script>
</head>
<body class="h-full flex flex-col bg-slate-50 dark:bg-slate-900 overflow-hidden m-0 font-sans">
    <header class="shrink-0 z-50 backdrop-blur-xl bg-white/70 dark:bg-slate-900/70 border-b border-white/20 dark:border-slate-800 shadow-sm transition-colors duration-300">
        <div class="px-6 py-4 flex justify-between items-center w-full">
            
            <div class="flex items-center gap-4">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.dashboard') }}" class="p-2 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div class="h-6 w-px bg-slate-200 dark:bg-slate-700 hidden sm:block"></div>
                <span class="text-2xl font-extrabold tracking-tighter text-blue-600 dark:text-blue-500 hidden sm:flex items-center gap-2">
                    <img src="{{ asset('assets/img/logo/BikinWebsiteLogo.png') }}" alt="Logo BikinWebsite" class="h-9 w-9 object-contain">
                    <span>Bikin<span class="font-light">Website</span></span>
                </span>
            </div>
            
            <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-800/50 p-1 rounded-full border border-slate-200 dark:border-slate-700">
                <button id="desktop-btn" onclick="setDeviceView('desktop')" class="px-4 py-2 rounded-full bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-sm transition-all text-sm font-bold flex items-center gap-2" title="Desktop View">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="hidden md:inline">Desktop</span>
                </button>
                <button id="mobile-btn" onclick="setDeviceView('mobile')" class="px-4 py-2 rounded-full text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-all text-sm font-medium flex items-center gap-2" title="Mobile View">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <span class="hidden md:inline">Mobile</span>
                </button>
            </div>
            
            <div>
                @if(auth()->check())
                    <form action="{{ route('user.project.create', $template->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-semibold bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5 inline-flex items-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span class="hidden sm:inline">Edit template ini</span>
                            <span class="sm:hidden">Edit</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all transform hover:-translate-y-0.5 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        <span class="hidden sm:inline">Login untuk edit</span>
                        <span class="sm:hidden">Login</span>
                    </a>
                @endif
            </div>
        </div>
    </header>

    @if(session('error'))
    <div class="absolute top-24 left-1/2 transform -translate-x-1/2 z-[60] bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-2xl shadow-xl flex items-center gap-3 w-max max-w-[90vw]">
        <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <p class="font-medium text-sm">{{ session('error') }}</p>
        <button onclick="this.parentElement.style.display='none'" class="ml-2 text-red-400 hover:text-red-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif
    
    <div class="grow flex items-center justify-center bg-slate-200/50 dark:bg-slate-900/50 w-full overflow-hidden">
        <div class="h-full w-full flex justify-center transition-all duration-300">
            <iframe id="preview-iframe" src="{{ asset('storage/previews/' . \Str::slug($template->name) . '/index.html') }}" class="h-full w-full bg-white shadow-xl border-x border-slate-300 dark:border-slate-700 transition-all duration-300"></iframe>
        </div>
    </div>
</body>
</html>
