@extends('user.layouts.app')
@section('title', 'Website Builder')
@section('content')
<main class="grow relative z-10 overflow-hidden">
    <!-- HERO SECTION -->
    <section class="relative pt-24 pb-20 md:pt-32 md:pb-32 lg:min-h-[85vh] flex items-center">
        <!-- background blur circles -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[10%] left-[5%] w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 animate-pulse"></div>
            <div class="absolute bottom-[20%] right-[10%] w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8">
                <!-- Text Content -->
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6 leading-[1.15]">
                        Buat Website Impian <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600">Tanpa Menulis Kode.</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-lg md:text-xl mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Platform pembuatan website paling intuitif. Pilih template, sesuaikan desain dengan <i>drag-and-drop</i>, dan publikasikan usahamu secara profesional dalam hitungan menit.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('user.templates') }}" class="w-full sm:w-auto bg-blue-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Mulai Desain Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="#how-it-works" class="w-full sm:w-auto bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 px-8 py-4 rounded-full font-semibold text-lg border border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-800/80 transition-all text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                    <div class="mt-8 flex items-center justify-center lg:justify-start gap-4 text-sm text-slate-500 dark:text-slate-400 font-medium">
                        <div class="flex -space-x-2">
                            <img src="https://images.unsplash.com/photo-1530404805506-c03b57ae586f?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="User 1" class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-900 object-cover">
                            <img src="https://images.unsplash.com/photo-1516011362164-3095a82b0af9?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="User 2" class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-900 object-cover">
                            <img src="https://images.unsplash.com/photo-1559732658-9ef4bc86cfcd?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="User 3" class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-900 object-cover">
                        </div>
                        <span>Dipercaya oleh 1000+ pengguna</span>
                    </div>
                </div>
                
                <!-- Hero Image/Mockup -->
                <div class="lg:w-1/2 relative w-full max-w-2xl lg:max-w-none">
                    <div class="relative rounded-2xl overflow-hidden ">
                        <img src="{{ asset('assets/img/hero-mockup.png') }}" alt="Happy user holding laptop" class="w-full h-auto">
                    </div>
                    
                    <!-- Floating Cards to simulate UI -->
                    <div class="hidden md:flex absolute -left-12 bottom-12 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md p-4 rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">Website Published!</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Baru saja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SPONSORS / LOGOS -->
    <section class="py-10 border-y border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 relative z-10">
        <div class="max-w-7xl mx-auto px-6 overflow-hidden">
            <p class="text-center text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6">Cocok untuk berbagai industri</p>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-300">
                <span class="text-xl font-black text-slate-800 dark:text-slate-300">Toko Online</span>
                <span class="text-xl font-black text-slate-800 dark:text-slate-300">Portofolio</span>
                <span class="text-xl font-black text-slate-800 dark:text-slate-300">Blog Pribadi</span>
                <span class="text-xl font-black text-slate-800 dark:text-slate-300">Perusahaan</span>
                <span class="text-xl font-black text-slate-800 dark:text-slate-300">Agensi Digital</span>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="py-24 relative z-10 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">Fitur Lengkap untuk Kesuksesanmu</h2>
                <p class="text-slate-500 dark:text-slate-400 text-lg">Semua yang kamu butuhkan untuk membuat website profesional, performa tinggi, dan mudah dikelola tanpa perlu memahami bahasa pemrograman.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/40 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Drag & Drop Editor</h3>
                    <p class="text-slate-500 dark:text-slate-400">Atur tata letak dengan mudah. Pindahkan elemen, ubah warna, dan sesuaikan teks secara langsung.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/40 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Desain Responsif</h3>
                    <p class="text-slate-500 dark:text-slate-400">Website Anda akan secara otomatis menyesuaikan tampilan agar sempurna di desktop, tablet, maupun mobile.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900/40 rounded-2xl flex items-center justify-center text-green-600 dark:text-green-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">SEO Optimized & Cepat</h3>
                    <p class="text-slate-500 dark:text-slate-400">Dibuat dengan kode yang bersih agar website Anda memuat lebih cepat dan mudah ditemukan di Google.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section id="how-it-works" class="py-24 relative z-10 bg-slate-50 dark:bg-slate-900/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">Cara Mulai dalam 3 Langkah Mudah</h2>
            </div>
            
            <div class="flex flex-col md:flex-row items-start justify-between relative gap-8 md:gap-4">
                <!-- Line connector for desktop -->
                <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-200 dark:from-slate-700 dark:via-blue-600 dark:to-slate-700 -z-10"></div>
                
                <!-- Step 1 -->
                <div class="flex-1 text-center relative">
                    <div class="w-24 h-24 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl font-black text-blue-600 dark:text-blue-400 shadow-xl border-4 border-slate-50 dark:border-slate-900 mb-6">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Pilih Template</h3>
                    <p class="text-slate-500 dark:text-slate-400 max-w-xs mx-auto text-sm">Pilih desain dari puluhan template siap pakai yang disesuaikan dengan kategorimu.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="flex-1 text-center relative">
                    <div class="w-24 h-24 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl font-black text-blue-600 dark:text-blue-400 shadow-xl border-4 border-slate-50 dark:border-slate-900 mb-6">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Sesuaikan Desain</h3>
                    <p class="text-slate-500 dark:text-slate-400 max-w-xs mx-auto text-sm">Ganti teks, gambar, dan warna sesuai dengan identitas <i>brand</i> kamu.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="flex-1 text-center relative">
                    <div class="w-24 h-24 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-black shadow-xl shadow-blue-600/30 border-4 border-slate-50 dark:border-slate-900 mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Publikasi</h3>
                    <p class="text-slate-500 dark:text-slate-400 max-w-xs mx-auto text-sm">Selesai! Website kamu siap diakses oleh pengunjung dari seluruh dunia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TEMPLATES SECTION -->
    <section id="templates" class="py-24 overflow-hidden bg-white dark:bg-slate-900 relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">Katalog Template</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-lg">Desain profesional yang siap digunakan.</p>
                </div>
                
                <div class="flex gap-2 flex-wrap bg-slate-50 dark:bg-slate-800/80 p-1.5 rounded-full border border-slate-100 dark:border-slate-700 transition-colors" id="category-filter-container">
                    <button data-filter="semua" class="filter-btn px-6 py-2.5 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm font-semibold rounded-full shadow-sm transition-all">Semua</button>
                    
                    @foreach($categories as $index => $category)
                        <button data-filter="{{ strtolower($category->name) }}" class="filter-btn category-item px-6 py-2.5 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                    @if(count($categories) > 3)
                        <button id="toggleCategoriesBtn" class="px-4 py-2 text-slate-500 dark:text-slate-400 text-sm font-bold rounded-full hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Lihat semua kategori">
                            &raquo;
                        </button>
                    @endif
                </div>
            </div>
            
            <div id="template-slider" class="flex gap-6 md:gap-8 overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth pb-12 -mx-6 px-6 md:mx-0 md:px-0">
                @forelse($templates as $template)
                    @php
                        $thumbnailUrl = is_array($template->photos) && count($template->photos) > 0 ? asset('storage/' . $template->photos[0]) : '';
                        $categoryName = $template->category->name ?? 'Kategori';
                    @endphp
                    <div data-category="{{ strtolower($categoryName) }}" class="template-card shrink-0 w-[85vw] sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] snap-center sm:snap-start group relative bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-300 flex flex-col">
                        <div class="aspect-[4/3] w-full bg-slate-100 dark:bg-slate-900 relative overflow-hidden shrink-0 cursor-pointer" onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')">
                            @if($thumbnailUrl)
                                <img src="{{ $thumbnailUrl }}" alt="{{ $template->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                                
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                    <span class="bg-white text-slate-900 px-5 py-2.5 rounded-full text-sm font-bold shadow-xl flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        Pratinjau
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider z-10 pointer-events-none border border-slate-200/50 dark:border-slate-700/50">
                                {{ $categoryName }}
                            </div>
                        </div>

                        <div class="p-8 flex flex-col grow">
                            <h4 class="font-bold text-2xl text-slate-900 dark:text-white mb-2">{{ $template->name }}</h4>
                            <p class="text-slate-500 dark:text-slate-400 mb-8 line-clamp-2 grow">{{ $template->description }}</p>
                            <div class="flex gap-3 mt-auto">
                                <button onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')" class="flex-1 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600 py-3.5 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors flex items-center justify-center gap-2">
                                    Lihat
                                </button>
                                <button class="use-template-btn flex-1 bg-blue-600 text-white py-3.5 rounded-xl font-bold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-sm shadow-blue-600/20">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-20 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-slate-700">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Belum ada template yang tersedia.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('user.templates') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 font-bold hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                    Lihat Semua Template
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- FINAL CTA SECTION -->
    <section class="py-24 relative z-10 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[3rem] p-10 md:p-16 text-center md:text-left flex flex-col md:flex-row items-center justify-between relative overflow-hidden shadow-2xl shadow-blue-600/30">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMiIgZmlsbD0iI2ZmZiIgZmlsbC1vcGFjaXR5PSIwLjE1Ii8+PC9zdmc+')] opacity-40"></div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-2xl"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-white rounded-full mix-blend-overlay opacity-10 blur-2xl"></div>
                
                <div class="relative z-10 md:w-2/3 mb-8 md:mb-0">
                    <h3 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">Siap Membangun Kehadiran Digitalmu?</h3>
                    <p class="text-blue-100 text-lg md:text-xl max-w-xl leading-relaxed">Mulai buat website dengan gratis hari ini. Tidak perlu kartu kredit, tidak butuh koding.</p>
                </div>
                
                <div class="relative z-10 md:w-1/3 flex justify-center md:justify-end w-full">
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-5 rounded-full font-bold text-xl hover:bg-slate-50 transition-all shadow-xl hover:shadow-2xl hover:scale-105 w-full md:w-auto text-center">
                        Buat Akun Gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- AUTH ALERT MODAL (Existing) -->
    <div id="auth-alert-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeAuthAlert()"></div>
        
        <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] shadow-2xl shadow-blue-900/20 dark:shadow-black/50 max-w-sm w-full mx-6 transform scale-95 transition-all duration-300 border border-slate-100 dark:border-slate-700" id="auth-alert-box">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-blue-50 dark:bg-blue-900/30 rounded-full text-blue-600 dark:text-blue-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            
            <h3 class="text-2xl font-bold text-center text-slate-900 dark:text-white mb-3 tracking-tight">Akses Terbatas</h3>
            <p class="text-center text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
                Silakan masuk atau daftar terlebih dahulu untuk menggunakan dan mendesain template ini.
            </p>
            
            <div class="flex flex-col gap-3">
                <a href="{{ route('login') }}" class="w-full px-4 py-3.5 rounded-2xl font-bold text-white bg-blue-600 hover:bg-blue-700 text-center transition-colors shadow-lg shadow-blue-600/30">
                    Login Sekarang
                </a>
                <button onclick="closeAuthAlert()" class="w-full px-4 py-3.5 rounded-2xl font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>

    <!-- IMAGE MODAL (Existing) -->
    <div id="image-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/95 backdrop-blur-md transition-opacity" onclick="closeImageModal()"></div>
        <div class="relative z-10 max-w-6xl w-full mx-4 flex flex-col items-center transform scale-95 transition-transform duration-300" id="image-modal-content">
            <button onclick="closeImageModal()" class="absolute -top-14 right-0 text-white/50 hover:text-white transition-colors p-2 focus:outline-none bg-white/10 rounded-full hover:bg-white/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <img id="modal-image-src" src="" alt="Full screen preview" class="w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
            <p id="modal-image-title" class="text-white mt-6 font-bold text-xl tracking-wide"></p>
        </div>
    </div>
</main>

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    const authAlertModal = document.getElementById('auth-alert-modal');
    const authAlertBox = document.getElementById('auth-alert-box');

    function openAuthAlert() {
        authAlertModal.classList.remove('hidden');
        setTimeout(() => {
            authAlertModal.classList.remove('opacity-0');
            authAlertBox.classList.remove('scale-95');
            authAlertBox.classList.add('scale-100');
        }, 10);
    }

    function closeAuthAlert() {
        authAlertModal.classList.add('opacity-0');
        authAlertBox.classList.remove('scale-100');
        authAlertBox.classList.add('scale-95');
        setTimeout(() => {
            authAlertModal.classList.add('hidden');
        }, 300); 
    }

    const imageModal = document.getElementById('image-modal');
    const imageModalContent = document.getElementById('image-modal-content');
    const modalImageSrc = document.getElementById('modal-image-src');
    const modalImageTitle = document.getElementById('modal-image-title');

    function openImageModal(imgSrc, title) {
        if (!imgSrc) return; 
        modalImageSrc.src = imgSrc;
        modalImageTitle.textContent = title;
        
        imageModal.classList.remove('hidden');
        
        setTimeout(() => {
            imageModal.classList.remove('opacity-0');
            imageModalContent.classList.remove('scale-95');
            imageModalContent.classList.add('scale-100');
        }, 10);
    }

    function closeImageModal() {
        imageModal.classList.add('opacity-0');
        imageModalContent.classList.remove('scale-100');
        imageModalContent.classList.add('scale-95');
        
        setTimeout(() => {
            imageModal.classList.add('hidden');
            modalImageSrc.src = ''; 
        }, 300);
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape" && !imageModal.classList.contains('hidden')) {
            closeImageModal();
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const categoryItems = document.querySelectorAll('.category-item');
        const toggleCategoriesBtn = document.getElementById('toggleCategoriesBtn');
        const cards = document.querySelectorAll('.template-card');
        const slider = document.getElementById('template-slider');
        const useTemplateBtns = document.querySelectorAll('.use-template-btn');
        
        let isShowingAllCategories = false;

        useTemplateBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (!isLoggedIn) {
                    e.preventDefault(); 
                    openAuthAlert();    
                }
            });
        });

        if (toggleCategoriesBtn) {
            toggleCategoriesBtn.addEventListener('click', () => {
                isShowingAllCategories = !isShowingAllCategories;
                
                categoryItems.forEach((item, index) => {
                    if (index >= 3) {
                        item.style.display = isShowingAllCategories ? 'inline-block' : 'none';
                    }
                });

                toggleCategoriesBtn.innerHTML = isShowingAllCategories ? '&laquo;' : '&raquo;';
                toggleCategoriesBtn.title = isShowingAllCategories ? 'Sembunyikan' : 'Lihat semua kategori';
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-white', 'dark:bg-slate-700', 'text-slate-800', 'dark:text-white', 'shadow-sm');
                    b.classList.add('text-slate-500', 'dark:text-slate-400');
                });
                
                btn.classList.remove('text-slate-500', 'dark:text-slate-400');
                btn.classList.add('bg-white', 'dark:bg-slate-700', 'text-slate-800', 'dark:text-white', 'shadow-sm');
                
                const filterValue = btn.getAttribute('data-filter');
                
                cards.forEach(card => {
                    if (filterValue === 'semua' || card.getAttribute('data-category') === filterValue) {
                        card.style.display = 'flex';
                        card.style.opacity = '0';
                        setTimeout(() => card.style.opacity = '1', 50);
                    } else {
                        card.style.display = 'none';
                    }
                });

                slider.scrollTo({ left: 0, behavior: 'smooth' });
            });
        });

        let autoScrollInterval;
        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                const visibleCards = Array.from(cards).filter(c => c.style.display !== 'none');
                if(visibleCards.length === 0) return;

                const scrollStep = visibleCards[0].offsetWidth + 32;

                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                    slider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    slider.scrollBy({ left: scrollStep, behavior: 'smooth' });
                }
            }, 2500); 
        }

        startAutoScroll();

        slider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
        slider.addEventListener('touchstart', () => clearInterval(autoScrollInterval));
        slider.addEventListener('mouseleave', startAutoScroll);
        slider.addEventListener('touchend', startAutoScroll);
    });
</script>
@endsection