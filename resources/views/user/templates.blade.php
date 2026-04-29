@extends('user.layouts.app')
@section('title', 'Katalog Template')
@section('content')
<main class="grow relative z-10 flex flex-col">
    <section class="pt-32 pb-24 px-6">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6">
                    Jelajahi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">Katalog Template</span>
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-lg">
                    Temukan desain terbaik untuk bisnis UMKM kamu. Tersedia berbagai pilihan template modern, responsif, dan siap digunakan untuk memajukan usahamu.
                </p>
            </div>

            <div class="flex justify-center mb-14">
                <div class="flex gap-2 flex-wrap justify-center bg-slate-50 dark:bg-slate-800/50 p-2 rounded-full border border-slate-200 dark:border-slate-700/50 transition-colors">
                    <button data-filter="semua" class="filter-btn px-6 py-2.5 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm font-semibold rounded-full shadow-sm transition-all">Semua</button>
                    @foreach($categories as $category)
                        <button data-filter="{{ strtolower($category->name) }}" class="filter-btn px-6 py-2.5 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div id="template-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($templates as $template)
                    @php
                        $thumbnailUrl = is_array($template->photos) && count($template->photos) > 0 ? asset('storage/' . $template->photos[0]) : '';
                    @endphp
                    
                    <div data-category="{{ strtolower($template->category->name ?? '') }}" class="template-card group relative bg-white dark:bg-slate-800/60 rounded-3xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 flex flex-col">
                        <div class="aspect-[4/3] w-full bg-slate-100 dark:bg-slate-800 relative overflow-hidden shrink-0">
                            @if($thumbnailUrl)
                                <img src="{{ $thumbnailUrl }}" alt="{{ $template->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider">
                                {{ $template->category->name ?? 'Kategori' }}
                            </div>
                        </div>
                        
                        <div class="p-6 flex flex-col grow">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-2">{{ $template->name }}</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 line-clamp-2 grow">{{ $template->description }}</p>
                            
                            <button class="w-full bg-slate-900 dark:bg-blue-600 text-white py-3.5 rounded-2xl font-semibold hover:bg-slate-800 dark:hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 mt-auto">
                                Gunakan Template
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400 text-lg font-medium">Belum ada template yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
    
    <div id="auth-alert-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeAuthAlert()"></div>
        <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] shadow-2xl shadow-blue-900/10 dark:shadow-black/40 max-w-sm w-full mx-6 transform scale-95 transition-all duration-300 border border-slate-100 dark:border-slate-700" id="auth-alert-box">
            <div class="flex items-center justify-center w-14 h-14 mx-auto mb-5 bg-blue-50 dark:bg-slate-700/50 rounded-full text-blue-600 dark:text-blue-400">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-center text-slate-900 dark:text-white mb-2 tracking-tight">Akses Terbatas</h3>
            <p class="text-center text-slate-500 dark:text-slate-400 mb-8 text-sm leading-relaxed">
                Silakan masuk atau daftar terlebih dahulu untuk menggunakan dan mendesain template ini.
            </p>
            <div class="flex gap-3">
                <button onclick="closeAuthAlert()" class="flex-1 px-4 py-3 rounded-2xl font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors text-sm">
                    Nanti Saja
                </button>
                <a href="{{ route('login') }}" class="flex-1 px-4 py-3 rounded-2xl font-semibold text-white bg-blue-600 hover:bg-blue-700 text-center transition-colors shadow-lg shadow-blue-600/30 text-sm flex items-center justify-center">
                    Login Sekarang
                </a>
            </div>
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

    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.template-card');
        const useTemplateBtns = document.querySelectorAll('.template-card button');
        useTemplateBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (!isLoggedIn) {
                    e.preventDefault(); 
                    openAuthAlert();    
                } else {
                }
            });
        });

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
            });
        });
    });
</script>
@endsection