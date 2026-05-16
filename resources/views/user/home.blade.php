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
                    <p class="text-slate-600 dark:text-slate-400 text-lg md:text-xl mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
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
                    <div class="mt-8 flex items-center justify-center lg:justify-start gap-4 text-sm text-slate-600 dark:text-slate-400 font-medium">
                        <div class="flex -space-x-2 overflow-hidden">
                           <div class="flex -space-x-2 overflow-hidden">
                                <img 
                                    src="https://images.unsplash.com/photo-1530404805506-c03b57ae586f?q=80&w=64&auto=format&fit=crop&format=webp" 
                                    alt="Foto profil pengguna Bisite" 
                                    width="32" 
                                    height="32"
                                    loading="lazy"
                                    class="inline-block w-8 h-8 rounded-full border-2 border-white dark:border-slate-900 object-cover ring-2 ring-transparent hover:z-10 transition-transform hover:scale-110"
                                >
                                <img 
                                    src="https://images.unsplash.com/photo-1516011362164-3095a82b0af9?q=80&w=64&auto=format&fit=crop&format=webp" 
                                    alt="Testimoni pengguna platform" 
                                    width="32" 
                                    height="32"
                                    loading="lazy"
                                    class="inline-block w-8 h-8 rounded-full border-2 border-white dark:border-slate-900 object-cover ring-2 ring-transparent hover:z-10 transition-transform hover:scale-110"
                                >
                                <img 
                                    src="https://images.unsplash.com/photo-1559732658-9ef4bc86cfcd?q=80&w=64&auto=format&fit=crop&format=webp" 
                                    alt="Avatar member aktif" 
                                    width="32" 
                                    height="32"
                                    loading="lazy"
                                    class="inline-block w-8 h-8 rounded-full border-2 border-white dark:border-slate-900 object-cover ring-2 ring-transparent hover:z-10 transition-transform hover:scale-110"
                                >
                            </div>
                        </div>
                        <span>Dipercaya oleh 1,000+ pengguna</span>
                    </div>
                </div>
                
                <!-- Hero Image/Mockup -->
                <div class="lg:w-1/2 relative w-full max-w-2xl lg:max-w-none">
                    <div class="relative rounded-2xl overflow-hidden ">
                        <img src="{{ asset('assets/img/hero-mockup.png') }}" width="612" height="408" fetchpriority="high" alt="Happy user holding laptop" class="w-full h-auto object-cover md:object-contain drop-shadow-2xl translate-y-4 md:translate-y-8 group-hover:translate-y-2 md:group-hover:translate-y-4 transition-transform duration-700">
                    </div>
                    
                    <!-- Floating Cards to simulate UI -->
                    <div class="flex absolute bottom-4 left-4 md:-left-12 md:bottom-12 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md p-2 md:p-4 rounded-lg md:rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 items-center gap-2 md:gap-4 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-6 h-6 md:w-10 md:h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 shrink-0">
                            <svg class="w-3.5 h-3.5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs md:text-sm font-bold text-slate-900 dark:text-white whitespace-nowrap">Website Published!</p>
                            <p class="text-[10px] md:text-xs text-slate-600 dark:text-slate-400">Baru saja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SPONSORS / LOGOS -->
    <section class="py-10 border-y border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 relative z-10">
        <div class="max-w-7xl mx-auto px-6 overflow-hidden">
            <p class="text-center text-sm font-bold text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-6">Cocok untuk berbagai industri</p>
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
                <p class="text-slate-600 dark:text-slate-400 text-lg">Semua yang kamu butuhkan untuk membuat website profesional, performa tinggi, dan mudah dikelola tanpa perlu memahami bahasa pemrograman.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/40 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Drag & Drop Editor</h3>
                    <p class="text-slate-600 dark:text-slate-400">Atur tata letak dengan mudah. Pindahkan elemen, ubah warna, dan sesuaikan teks secara langsung.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/40 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Desain Responsif</h3>
                    <p class="text-slate-600 dark:text-slate-400">Website Anda akan secara otomatis menyesuaikan tampilan agar sempurna di desktop, tablet, maupun mobile.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900/40 rounded-2xl flex items-center justify-center text-green-600 dark:text-green-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">SEO Optimized & Cepat</h3>
                    <p class="text-slate-600 dark:text-slate-400">Dibuat dengan kode yang bersih agar website Anda memuat lebih cepat dan mudah ditemukan di Google.</p>
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
            
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between relative gap-12 md:gap-4 w-full">
                <!-- Line connector for desktop -->
                <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-200 dark:from-slate-700 dark:via-blue-600 dark:to-slate-700 -z-10"></div>
                
                <!-- Step 1 -->
                <div class="w-full flex-1 text-center relative">
                    <div class="w-24 h-24 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl font-black text-blue-600 dark:text-blue-400 shadow-xl border-4 border-slate-50 dark:border-slate-900 mb-6">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Pilih Template</h3>
                    <p class="text-slate-600 dark:text-slate-400 max-w-xs mx-auto text-sm">Pilih desain dari puluhan template siap pakai yang disesuaikan dengan kategorimu.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="w-full flex-1 text-center relative">
                    <div class="w-24 h-24 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl font-black text-blue-600 dark:text-blue-400 shadow-xl border-4 border-slate-50 dark:border-slate-900 mb-6">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Sesuaikan Desain</h3>
                    <p class="text-slate-600 dark:text-slate-400 max-w-xs mx-auto text-sm">Ganti teks, gambar, dan warna sesuai dengan identitas <i>brand</i> kamu.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="w-full flex-1 text-center relative">
                    <div class="w-24 h-24 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-black shadow-xl shadow-blue-600/30 border-4 border-slate-50 dark:border-slate-900 mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Publikasi</h3>
                    <p class="text-slate-600 dark:text-slate-400 max-w-xs mx-auto text-sm">Selesai! Website kamu siap diakses oleh pengunjung dari seluruh dunia.</p>
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
                    <p class="text-slate-600 dark:text-slate-400 text-lg">Desain profesional yang siap digunakan.</p>
                </div>
            </div>
            
            <div id="template-slider" class="flex gap-6 md:gap-8 overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth pb-12 -mx-6 px-6 md:mx-0 md:px-0">
                @forelse($templates as $template)
                    @php
                        $thumbnailUrl = $template->photos ? asset('storage/' . $template->photos) : '';
                        $categoryName = $template->category->name ?? 'Kategori';
                    @endphp
                    <div data-category="{{ strtolower($categoryName) }}" class="template-card shrink-0 w-[85vw] sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] snap-center sm:snap-start group relative bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-300 flex flex-col">
                        <div class="aspect-[4/3] w-full bg-slate-100 dark:bg-slate-900 relative overflow-hidden shrink-0 cursor-pointer" onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')">
                            @if($thumbnailUrl)
                                <img src="{{ $thumbnailUrl }}" alt="{{ $template->name }}" loading="lazy" width="800" height="600" decoding="async" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                                
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                    <span class="bg-white text-slate-900 px-5 py-2.5 rounded-full text-sm font-bold shadow-xl flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        Perbesar gambar
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-500 dark:text-slate-400">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider z-10 pointer-events-none border border-slate-200/50 dark:border-slate-700/50">
                                {{ $categoryName }}
                            </div>
                        </div>

                        <div class="p-8 flex flex-col grow">
                            <h3 class="font-bold text-2xl text-slate-900 dark:text-white mb-2">{{ $template->name }}</h3>
                            <p class="text-slate-600 dark:text-slate-400 mb-8 line-clamp-2 grow">{{ $template->description }}</p>
                            <div class="flex gap-3 mt-auto">
                                <a href="{{ URL::signedRoute('template.preview', $template->id) }}" target="_blank" class="flex-1 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600 py-3.5 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors flex items-center justify-center gap-2">
                                    Lihat
                                </a>
                                <form action="{{ route('user.project.create', $template->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="use-template-btn w-full bg-blue-600 text-white py-3.5 rounded-xl font-bold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-sm shadow-blue-600/20">
                                        Edit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-20 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-slate-700">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-slate-600 dark:text-slate-400 font-medium text-lg">Belum ada template yang tersedia.</p>
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

    
    <section id="pricing" class="py-24 relative z-10 bg-slate-50 dark:bg-slate-900/30 border-y border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">Investasi Terjangkau untuk Bisnismu</h2>
                <p class="text-slate-600 dark:text-slate-400 text-lg">Pilih paket yang sesuai dengan kebutuhanmu. Bayar sekali, berlaku selamanya selama masa promo.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Lite Tier -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all flex flex-col relative overflow-hidden">
                    @if(auth()->check() && auth()->user()->tier === 'lite')
                        <div class="mb-4 self-start inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase tracking-wider border border-blue-200/50 dark:border-blue-800/50">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                            Role kamu sekarang
                        </div>
                    @endif
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Lite</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-6">Cocok untuk pemula yang ingin mencoba.</p>
                    <div class="mb-8">
                        <span class="text-4xl font-extrabold text-slate-900 dark:text-white">Gratis</span>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>1 Project Website</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Sub-domain (.bisite.web.id)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Akses Semua Template</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-500 dark:text-slate-400">
                            <svg class="w-5 h-5 text-slate-400 dark:text-slate-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <span>Custom Domain (.com, .id)</span>
                        </li>
                    </ul>
                    @if(!auth()->check())
                        <a href="{{ route('register') }}" class="block w-full py-4 px-6 text-center rounded-xl font-bold border-2 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-blue-600 hover:text-blue-600 dark:hover:border-blue-500 dark:hover:text-blue-500 transition-colors">
                            Mulai Gratis
                        </a>
                    @else
                        <div class="w-full py-4 px-6 text-center rounded-xl font-bold bg-slate-100 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700 cursor-default flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Sudah Terdaftar
                        </div>
                    @endif
                </div>

                <!-- Pro Tier -->
                <div class="bg-blue-700 rounded-3xl p-8 border border-blue-700 shadow-2xl shadow-blue-700/30 transform md:-translate-y-4 flex flex-col relative">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-orange-400 to-pink-500 text-white text-xs font-bold uppercase tracking-wider py-1.5 px-4 rounded-full shadow-lg">
                        Paling Populer
                    </div>
                    @if(auth()->check() && auth()->user()->tier === 'pro')
                        <div class="mb-4 self-start inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-white text-[10px] font-bold uppercase tracking-wider border border-white/30 backdrop-blur-md">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            Role kamu sekarang
                        </div>
                    @endif
                    <h3 class="text-2xl font-bold text-white mb-2">Pro</h3>
                    <p class="text-white text-sm mb-6">Cocok untuk UMKM dan pekerja profesional.</p>
                    <div class="mb-8 flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-white">Rp 50rb</span>
                        <span class="text-white text-sm">/sekali bayar</span>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3 text-white">
                            <svg class="w-5 h-5 text-green-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Maksimal 5 Project Website</span>
                        </li>
                        <li class="flex items-start gap-3 text-white">
                            <svg class="w-5 h-5 text-green-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Akses Semua Template</span>
                        </li>

                        <li class="flex items-start gap-3 text-white">
                            <svg class="w-5 h-5 text-green-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Prioritas Support & Update</span>
                        </li>
                        <li class="flex items-start gap-3 text-white">
                            <svg class="w-5 h-5 text-white opacity-50 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <span>Custom Domain (.com, .id)</span>
                        </li>
                    </ul>
                    @if(auth()->check() && auth()->user()->tier === 'pro')
                        <div class="block w-full py-4 px-6 text-center rounded-xl font-bold bg-white/20 text-white border border-white/30 backdrop-blur-sm cursor-default flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Paket Aktif
                        </div>
                    @elseif(auth()->check() && auth()->user()->tier === 'elite')
                        <div class="block w-full py-4 px-6 text-center rounded-xl font-bold bg-black/10 text-white border border-white/10 cursor-default flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Tier Tinggi Aktif
                        </div>
                    @else
                        <button onclick="openUpgradeModal('Pro')" class="block w-full py-4 px-6 text-center rounded-xl font-bold bg-white text-blue-600 hover:bg-slate-50 transition-colors shadow-lg shadow-black/10">
                            Pilih Pro
                        </button>
                    @endif
                </div>

                <!-- Elite Tier -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all flex flex-col relative overflow-hidden">
                    @if(auth()->check() && auth()->user()->tier === 'elite')
                        <div class="mb-4 self-start inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/40 text-purple-600 dark:text-purple-400 text-[10px] font-bold uppercase tracking-wider border border-purple-200/50 dark:border-purple-800/50">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600 dark:bg-purple-400 animate-pulse"></span>
                            Role kamu sekarang
                        </div>
                    @endif
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Elite</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-6">Solusi lengkap untuk skala korporat.</p>
                    <div class="mb-8 flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-slate-900 dark:text-white">Rp 75rb</span>
                        <span class="text-slate-600 dark:text-slate-400 text-sm">/sekali bayar</span>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="font-bold text-blue-600 dark:text-blue-400">Project Website Tak Terbatas</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Semua Fitur di Paket Pro</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="font-bold text-purple-600 dark:text-purple-400">Integrasi Custom Domain</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Bantuan Setup Domain Penuh</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Support VIP 24/7 (WhatsApp)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Akses Eksklusif Fitur Baru</span>
                        </li>
                    </ul>
                    @if(auth()->check() && auth()->user()->tier === 'elite')
                        <div class="block w-full py-4 px-6 text-center rounded-xl font-bold bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 border border-purple-100 dark:border-purple-800/50 cursor-default flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Paket Aktif
                        </div>
                    @else
                        <button onclick="openUpgradeModal('Elite')" class="block w-full py-4 px-6 text-center rounded-xl font-bold border-2 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-purple-600 hover:text-purple-600 dark:hover:border-purple-500 dark:hover:text-purple-500 transition-colors">
                            Pilih Elite
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- FINAL CTA SECTION -->
    @guest
    <section class="py-24 relative z-10 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[3rem] p-10 md:p-16 text-center md:text-left flex flex-col md:flex-row items-center justify-between relative overflow-hidden shadow-2xl shadow-blue-600/30">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMiIgZmlsbD0iI2ZmZiIgZmlsbC1vcGFjaXR5PSIwLjE1Ii8+PC9zdmc+')] opacity-40"></div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white rounded-full mix-blend-overlay opacity-10 blur-2xl"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-white rounded-full mix-blend-overlay opacity-10 blur-2xl"></div>
                
                <div class="relative z-10 md:w-2/3 mb-8 md:mb-0">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">Siap Membangun Kehadiran Digitalmu?</h2>
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
    @endguest

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
            <p class="text-center text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
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
        <div class="relative z-10 max-w-6xl w-[calc(100%-2rem)] flex flex-col items-center transform scale-95 transition-transform duration-300" id="image-modal-content">
            <button onclick="closeImageModal()" aria-label="Tutup modal" class="absolute -top-12 md:-top-14 right-0 text-white/50 hover:text-white transition-colors p-2 focus:outline-none bg-white/10 rounded-full hover:bg-white/20">
                <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <img id="modal-image-src" src="" alt="Full screen preview" loading="lazy" decoding="async" class="w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
            <p id="modal-image-title" class="text-white mt-4 md:mt-6 font-bold text-lg md:text-xl tracking-wide text-center"></p>
        </div>
    </div>
    <!-- UPGRADE TIER MODAL -->
    <div id="upgrade-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeUpgradeModal()"></div>
        <div id="upgrade-modal-box" class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] shadow-2xl shadow-blue-900/20 dark:shadow-black/50 max-w-sm w-full mx-6 transform scale-95 transition-all duration-300 border border-slate-100 dark:border-slate-700">
            
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-5 rounded-full bg-gradient-to-br from-emerald-400 to-green-500 shadow-lg shadow-green-500/30">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
            </div>

            <!-- Badge tier -->
            <div class="text-center mb-1">
                <span id="upgrade-tier-badge" class="inline-block text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400">Paket Pro</span>
            </div>

            <!-- Title & desc -->
            <h3 class="text-xl font-extrabold text-center text-slate-900 dark:text-white mb-3 tracking-tight mt-3">Upgrade Tier via WhatsApp</h3>
            <p class="text-center text-slate-600 dark:text-slate-400 mb-2 leading-relaxed text-sm">
                BikinWebsite masih dalam tahap pengembangan. Untuk upgrade ke paket 
                <span id="upgrade-tier-name" class="font-bold text-slate-700 dark:text-slate-200">Pro</span>,
                silakan hubungi admin kami langsung melalui WhatsApp.
            </p>
            <p class="text-center text-xs text-slate-500 dark:text-slate-400 mb-6">Proses cepat &amp; aman. Tim kami siap membantu! 🚀</p>

            <!-- Buttons -->
            <div class="flex flex-col gap-3">
                <a id="upgrade-wa-btn" href="https://wa.me/628978657617" target="_blank" rel="noopener noreferrer"
                    class="w-full flex items-center justify-center gap-2.5 px-4 py-3.5 rounded-2xl font-bold text-white bg-emerald-500 hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Hubungi Admin via WhatsApp
                </a>
                <button onclick="closeUpgradeModal()" class="w-full px-4 py-3.5 rounded-2xl font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>

</main>

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    // Upgrade Tier Modal
    const upgradeModal    = document.getElementById('upgrade-modal');
    const upgradeModalBox = document.getElementById('upgrade-modal-box');

    function openUpgradeModal(tier) {
        document.getElementById('upgrade-tier-badge').textContent = 'Paket ' + tier;
        document.getElementById('upgrade-tier-name').textContent  = tier;

        const waMsg  = encodeURIComponent('Halo Admin, saya ingin upgrade ke paket ' + tier + ' di BikinWebsite.');
        document.getElementById('upgrade-wa-btn').href = 'https://wa.me/628978657617?text=' + waMsg;

        upgradeModal.classList.remove('hidden');
        setTimeout(() => {
            upgradeModal.classList.remove('opacity-0');
            upgradeModalBox.classList.remove('scale-95');
            upgradeModalBox.classList.add('scale-100');
        }, 10);
    }

    function closeUpgradeModal() {
        upgradeModal.classList.add('opacity-0');
        upgradeModalBox.classList.remove('scale-100');
        upgradeModalBox.classList.add('scale-95');
        setTimeout(() => upgradeModal.classList.add('hidden'), 300);
    }

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