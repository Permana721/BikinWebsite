@extends('user.layouts.app')
@section('title', 'Website Builder UMKM')
@section('content')
<main class="grow relative z-10">
    <section class="pt-24 pb-20 md:pt-32 md:pb-28">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6 leading-[1.1] transition-colors">
                Buat Website Bisnismu <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">Tanpa Menulis Kode.</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed transition-colors">
                Pilih template, sesuaikan konten dengan editor <i>drag-and-drop</i>, dan tampilkan usahamu secara profesional ke dunia digital dalam hitungan menit.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('user.templates') }}" class="bg-blue-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-700 shadow-xl shadow-blue-600/30 transition-all transform hover:-translate-y-1 text-center">Mulai Desain Sekarang</a>
                <a href="#templates" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 px-8 py-4 rounded-full font-semibold text-lg border border-slate-200 dark:border-slate-700 hover:border-blue-200 dark:hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-slate-700 transition-all text-center">Lihat Template</a>
            </div>
        </div>
    </section>

    <section id="templates" class="py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">Katalog Template</h2>
                    <p class="text-slate-500 dark:text-slate-400">Desain siap pakai yang disesuaikan untuk berbagai jenis industri.</p>
                </div>
                
                <div class="flex gap-2 flex-wrap bg-slate-50 dark:bg-slate-900 p-1.5 rounded-full border border-slate-100 dark:border-slate-700 transition-colors" id="category-filter-container">
                    <button data-filter="semua" class="filter-btn px-5 py-2 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm font-semibold rounded-full shadow-sm transition-all">Semua</button>
                    
                    @foreach($categories as $index => $category)
                        <button data-filter="{{ strtolower($category->name) }}" class="filter-btn category-item px-5 py-2 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                    @if(count($categories) > 3)
                        <button id="toggleCategoriesBtn" class="px-3 py-2 text-slate-500 dark:text-slate-400 text-sm font-bold rounded-full hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Lihat semua kategori">
                            &raquo;
                        </button>
                    @endif
                </div>
            </div>
            
            <div id="template-slider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth pb-8 -mx-6 px-6 md:mx-0 md:px-0">
                @forelse($templates as $template)
                    @php
                        $thumbnailUrl = is_array($template->photos) && count($template->photos) > 0 ? asset('storage/' . $template->photos[0]) : '';
                        $categoryName = $template->category->name ?? 'Kategori';
                    @endphp
                    <div data-category="{{ strtolower($categoryName) }}" class="template-card shrink-0 w-[85vw] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] snap-center sm:snap-start group relative bg-[#FAFAFA] dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 flex flex-col">
                        <div class="aspect-[4/3] w-full bg-slate-200 dark:bg-slate-800 relative overflow-hidden shrink-0 cursor-pointer" onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')">
                            @if($thumbnailUrl)
                                <img src="{{ $thumbnailUrl }}" alt="{{ $template->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                                
                                <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                    <span class="bg-white/90 text-slate-900 px-4 py-2 rounded-full text-xs font-bold shadow-lg flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        Perbesar Gambar
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider z-10 pointer-events-none">
                                {{ $categoryName }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col grow">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-1">{{ $template->name }}</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 line-clamp-2 grow">{{ $template->description }}</p>
                            <button class="use-template-btn w-full bg-slate-900 dark:bg-blue-600 text-white py-3 rounded-2xl font-semibold hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 mt-auto">
                                Gunakan Template
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-10">
                        <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada template yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="py-24">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-blue-600 rounded-[3rem] p-12 text-center relative overflow-hidden shadow-2xl shadow-blue-600/20">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMiIgZmlsbD0iI2ZmZiIgZmlsbC1vcGFjaXR5PSIwLjIiLz48L3N2Zz4=')] opacity-30"></div>
                
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-white mb-4">Butuh Desain Khusus?</h3>
                    <p class="text-blue-100 mb-8 max-w-xl mx-auto text-lg">Tidak menemukan template yang cocok dengan identitas brand kamu? Hubungi tim kami untuk request custom template.</p>
                    <button class="bg-white text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-colors shadow-xl">Konsultasi via WhatsApp</button>
                </div>
            </div>
        </div>
    </section>

    <div id="auth-alert-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeAuthAlert()"></div>
        
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

    <div id="image-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/90 backdrop-blur-sm transition-opacity" onclick="closeImageModal()"></div>
        <div class="relative z-10 max-w-5xl w-full mx-4 flex flex-col items-center transform scale-95 transition-transform duration-300" id="image-modal-content">
            <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-slate-400 hover:text-white transition-colors p-2 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <img id="modal-image-src" src="" alt="Full screen preview" class="w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl">
            <p id="modal-image-title" class="text-white mt-4 font-semibold text-lg tracking-wide"></p>
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

                const scrollStep = visibleCards[0].offsetWidth + 24;

                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                    slider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    slider.scrollBy({ left: scrollStep, behavior: 'smooth' });
                }
            }, 2000); 
        }

        startAutoScroll();

        slider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
        slider.addEventListener('touchstart', () => clearInterval(autoScrollInterval));
        slider.addEventListener('mouseleave', startAutoScroll);
        slider.addEventListener('touchend', startAutoScroll);
    });
</script>
@endsection