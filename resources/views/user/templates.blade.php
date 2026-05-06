@extends('user.layouts.app')
@section('title', 'Katalog Template')
@section('content')
<main class="grow relative z-10 flex flex-col bg-[#FAFAFA] dark:bg-slate-900 pt-28 pb-20">
    <div class="max-w-7xl w-full mx-auto px-6 flex flex-col gap-8">
        <div class="flex-1 min-w-0 flex flex-col">
            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-8 text-center md:text-left">
                    Pilih Template <br class="hidden md:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">Terbaikmu</span>
                </h1>
                <div class="flex flex-col md:flex-row gap-4 max-w-4xl">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari template (mis: Toko, Portofolio...)" class="w-full pl-14 pr-4 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all font-medium text-lg shadow-sm hover:shadow-md">
                    </div>
                    <div class="relative w-full md:w-72">
                        <button id="categoryDropdownBtn" class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-900 dark:text-white font-medium text-lg shadow-sm hover:shadow-md focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            <span id="categoryDropdownText">Semua Template</span>
                            <svg id="categoryDropdownIcon" class="w-5 h-5 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div id="categoryDropdownMenu" class="absolute z-20 w-full mt-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-xl opacity-0 invisible transform scale-95 transition-all duration-200 origin-top">
                            <div class="py-2 max-h-64 overflow-y-auto hide-scroll" id="category-filter-container">
                                <button data-filter="semua" data-name="Semua Template" class="filter-btn w-full text-left px-5 py-3 text-blue-600 bg-blue-50 dark:bg-blue-900/40 dark:text-blue-400 font-bold transition-colors">
                                    Semua Template
                                </button>
                                @foreach($categories as $category)
                                    <button data-filter="{{ strtolower($category->name) }}" data-name="{{ $category->name }}" class="filter-btn w-full text-left px-5 py-3 text-slate-600 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-white transition-colors">
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="template-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8">
                @forelse($templates as $template)
                    @php
                        $thumbnailUrl = $template->photos ? asset('storage/' . $template->photos) : '';
                        $categoryName = strtolower($template->category->name ?? '');
                        $templateNameLower = strtolower($template->name);
                    @endphp
                    
                    <div data-category="{{ $categoryName }}" data-name="{{ $templateNameLower }}" class="template-card group relative bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-300 flex flex-col">
                        <div class="aspect-[4/3] w-full bg-slate-100 dark:bg-slate-900 relative overflow-hidden shrink-0">
                            @if($thumbnailUrl)
                                <img src="{{ $thumbnailUrl }}" alt="{{ $template->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                                
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px] z-10 gap-3">
                                    <button onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')" class="bg-white text-slate-900 px-5 py-2.5 rounded-full text-sm font-bold shadow-xl flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-all hover:bg-slate-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat
                                    </button>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider border border-slate-200/50 dark:border-slate-700/50 pointer-events-none z-0">
                                {{ $template->category->name ?? 'Kategori' }}
                            </div>
                        </div>
                        
                        <div class="p-6 flex flex-col grow">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-2">{{ $template->name }}</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 line-clamp-2 grow">{{ $template->description }}</p>
                            
                            <div class="flex gap-3 mt-auto">
                                <a href="{{ route('template.preview', $template->id) }}" target="_blank" class="flex-1 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600 py-3 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors flex items-center justify-center gap-2">
                                    Lihat
                                </a>
                                <button class="use-template-btn flex-1 bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-sm shadow-blue-600/20">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-slate-700">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Belum ada template yang tersedia.</p>
                    </div>
                @endforelse
            </div>
            <div id="no-results-msg" class="hidden text-center py-20 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-slate-700 mt-6">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white dark:bg-slate-800 shadow-sm text-slate-400 mb-6 border border-slate-100 dark:border-slate-700">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Template Tidak Ditemukan</h3>
                <p class="text-slate-500 dark:text-slate-400 text-lg max-w-md mx-auto">Coba gunakan kata kunci pencarian yang lain atau pilih kategori "Semua Template".</p>
            </div>
        </div>
    </div>
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
        const cards = document.querySelectorAll('.template-card');
        const useTemplateBtns = document.querySelectorAll('.use-template-btn');
        const searchInput = document.getElementById('searchInput');
        const noResultsMsg = document.getElementById('no-results-msg');
        
        let currentFilter = 'semua';
        let searchQuery = '';

        useTemplateBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (!isLoggedIn) {
                    e.preventDefault(); 
                    openAuthAlert();    
                }
            });
        });

        function filterTemplates() {
            let visibleCount = 0;
            
            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const name = card.getAttribute('data-name');
                
                const matchesCategory = currentFilter === 'semua' || category === currentFilter;
                const matchesSearch = name.includes(searchQuery);
                
                if (matchesCategory && matchesSearch) {
                    card.style.display = 'flex';
                    void card.offsetWidth;
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                    visibleCount++;
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        if(card.style.opacity === '0') card.style.display = 'none';
                    }, 300);
                }
            });

            if (visibleCount === 0 && cards.length > 0) {
                setTimeout(() => noResultsMsg.classList.remove('hidden'), 300);
            } else {
                noResultsMsg.classList.add('hidden');
            }
        }

        const dropdownBtn = document.getElementById('categoryDropdownBtn');
        const dropdownMenu = document.getElementById('categoryDropdownMenu');
        const dropdownIcon = document.getElementById('categoryDropdownIcon');
        const dropdownText = document.getElementById('categoryDropdownText');

        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isExpanded = dropdownMenu.classList.contains('opacity-100');
            
            if (isExpanded) {
                dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdownIcon.classList.remove('rotate-180');
            } else {
                dropdownMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                dropdownMenu.classList.add('opacity-100', 'visible', 'scale-100');
                dropdownIcon.classList.add('rotate-180');
            }
        });

        document.addEventListener('click', (e) => {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdownIcon.classList.remove('rotate-180');
            }
        });

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const text = btn.getAttribute('data-name');
                dropdownText.textContent = text;
                dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdownIcon.classList.remove('rotate-180');
                filterBtns.forEach(b => {
                    b.classList.remove('font-bold', 'text-blue-600', 'bg-blue-50', 'dark:bg-blue-900/40', 'dark:text-blue-400');
                    b.classList.add('font-medium', 'text-slate-600', 'dark:text-slate-300');
                });
                btn.classList.remove('font-medium', 'text-slate-600', 'dark:text-slate-300');
                btn.classList.add('font-bold', 'text-blue-600', 'bg-blue-50', 'dark:bg-blue-900/40', 'dark:text-blue-400');
                currentFilter = btn.getAttribute('data-filter');
                filterTemplates();
            });
        });
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase();
            filterTemplates();
        });
    });
</script>
@endsection