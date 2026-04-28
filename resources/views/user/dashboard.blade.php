<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Saya | WEB-UKM</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'], }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        /* Menyembunyikan scrollbar untuk area horizontal */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#FCFCFC] dark:bg-[#0B0F19] text-slate-800 dark:text-slate-200 min-h-screen flex flex-col transition-colors duration-300 selection:bg-blue-100 selection:text-blue-900">

    @include('user.layouts.header')

    <main class="grow flex flex-col">
        
        <div class="pt-16 pb-12 px-6 border-b border-slate-200/60 dark:border-slate-800/60">
            <div class="max-w-7xl mx-auto">
                <p class="text-sm font-medium text-slate-400 dark:text-slate-500 mb-2 tracking-wide uppercase">Workspace</p>
                <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-slate-900 dark:text-white mb-8">
                    Halo, {{ Auth::user()->name ?? 'Pengusaha' }}.
                </h1>
                
                <div class="flex flex-wrap items-center gap-x-8 gap-y-4 text-sm font-medium text-slate-600 dark:text-slate-400">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span>1  Project Aktif</span>
                    </div>
                    <div class="hidden sm:block w-px h-4 bg-slate-300 dark:bg-slate-700"></div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                        <span>45+ Template</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 w-full py-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white tracking-tight">Project Terakhir</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <a href="#katalog" class="group flex flex-col justify-center items-center h-full min-h-[280px] rounded-[2rem] border border-dashed border-slate-300 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-500 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-all duration-300">
                    <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/50 flex items-center justify-center text-slate-500 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="font-medium text-slate-600 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Buat Desain Baru</span>
                </a>

                <div class="group relative rounded-[2rem] p-3 bg-white dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:shadow-2xl hover:shadow-slate-200/40 dark:hover:shadow-none transition-all duration-300">
                    <div class="aspect-video w-full rounded-2xl overflow-hidden relative mb-4">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80" alt="Preview" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-slate-900/20 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 flex items-center justify-center gap-4 transition-opacity duration-300">
                            <a href="#" class="px-5 py-2.5 bg-white text-slate-900 text-sm font-semibold rounded-full hover:scale-105 transition-transform">Edit</a>
                            <a href="#" class="px-5 py-2.5 bg-slate-900/80 text-white text-sm font-semibold rounded-full hover:scale-105 transition-transform backdrop-blur-md">Preview</a>
                        </div>
                    </div>
                    <div class="px-2 pb-2">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-semibold text-slate-900 dark:text-white">Web Warung Kopi</h3>
                            <span class="w-2 h-2 rounded-full bg-amber-400" title="Draft"></span>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">Diedit 2 jam yang lalu</p>
                        
                        <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 transition-colors group/link">
                            Download Source
                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div id="katalog" class="w-full bg-slate-50 dark:bg-[#0E131F] py-20 border-t border-slate-200/60 dark:border-slate-800/60">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white tracking-tight mb-2">Eksplorasi</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Mulai karya barumu dari template pilihan.</p>
                    </div>
                    <a href="#" class="text-sm font-medium text-slate-900 dark:text-white underline underline-offset-4 decoration-slate-300 dark:decoration-slate-700 hover:decoration-slate-900 dark:hover:decoration-white transition-all">Lihat Semua</a>
                </div>

                <div class="flex gap-6 overflow-x-auto no-scrollbar snap-x snap-mandatory pb-8">
                    
                    <div class="shrink-0 w-[280px] snap-start group cursor-pointer">
                        <div class="aspect-[4/5] rounded-[2rem] overflow-hidden relative mb-4 bg-slate-200 dark:bg-slate-800">
                            <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&w=400&q=80" alt="Template" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md rounded-full text-[10px] font-bold uppercase tracking-wider text-slate-800 dark:text-slate-200">Fashion</span>
                            </div>
                            <div class="absolute inset-x-4 bottom-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                <button class="w-full py-3 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-slate-900 dark:text-white font-medium rounded-xl text-sm hover:bg-white transition-colors">
                                    Gunakan Desain
                                </button>
                            </div>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white">Aesthetic Wear</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Template elegan untuk butik dan rilis fashion terbaru.</p>
                    </div>
                    
                    </div>
            </div>
        </div>

    </main>

    @include('user.layouts.footer')

</body>
</html>