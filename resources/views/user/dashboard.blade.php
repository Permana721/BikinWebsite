@extends('user.layouts.app')
@section('title', 'Dasbor Saya')
@section('content')
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
                        <span>1 Project Aktif</span>
                    </div>
                    <div class="hidden sm:block w-px h-4 bg-slate-300 dark:bg-slate-700"></div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                        <span>{{ count($templates) }} Template</span>
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

        <div id="katalog" class="w-full py-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6">
                
                <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white tracking-tight mb-2">Eksplorasi</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Mulai karya barumu dari template pilihan.</p>
                    </div>
                    
                    <div class="flex gap-2 flex-wrap bg-slate-50 dark:bg-slate-900 p-1.5 rounded-full border border-slate-100 dark:border-slate-700 transition-colors" id="category-filter-container">
                        <button data-filter="semua" class="filter-btn px-5 py-2 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm font-semibold rounded-full shadow-sm transition-all">Semua</button>
                        
                        @php
                            $uniqueCategories = $templates->pluck('category')->unique('id');
                        @endphp

                        @foreach($uniqueCategories as $index => $category)
                            <button data-filter="{{ strtolower($category->name ?? '') }}" class="filter-btn category-item px-5 py-2 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                                {{ $category->name ?? 'Kategori' }}
                            </button>
                        @endforeach

                        @if(count($uniqueCategories) > 3)
                            <button id="toggleCategoriesBtn" class="px-3 py-2 text-slate-500 dark:text-slate-400 text-sm font-bold rounded-full hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Lihat semua kategori">
                                &raquo;
                            </button>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end mb-6">
                    <button id="loadMoreBtn" class="text-sm font-medium text-slate-900 dark:text-white underline underline-offset-4 decoration-slate-300 dark:decoration-slate-700 hover:decoration-slate-900 dark:hover:decoration-white transition-all focus:outline-none">
                        Lihat Lebih Banyak
                    </button>
                </div>

                <div id="template-slider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth pb-8 -mx-6 px-6 md:mx-0 md:px-0">
                    @forelse($templates as $index => $template)
                        @php
                            $thumbnailUrl = $template->photos ? asset('storage/' . $template->photos) : '';
                            $categoryName = $template->category->name ?? 'Kategori';
                        @endphp
                        
                        <div class="template-item shrink-0 w-[85vw] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] snap-center sm:snap-start group relative bg-[#FAFAFA] dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 flex flex-col" style="{{ $index >= 4 ? 'display: none;' : '' }}" data-category="{{ strtolower($categoryName) }}">
                            
                            <div class="aspect-[4/3] w-full bg-slate-200 dark:bg-slate-800 relative overflow-hidden shrink-0 cursor-pointer" onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')">
                                @if($thumbnailUrl)
                                    <img src="{{ $thumbnailUrl }}" alt="{{ $template->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                                    
                                    <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                        <span class="bg-white/90 text-slate-900 px-4 py-2 rounded-full text-xs font-bold shadow-lg flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                            Perbesar Gambar
                                        </span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-200 dark:bg-slate-800 text-slate-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider z-10 pointer-events-none">
                                    {{ $categoryName }}
                                </div>
                            </div>
                            
                            <div class="p-6 flex flex-col grow">
                                <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-1">{{ $template->name }}</h4>
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
                        <div class="w-full text-center py-10">
                            <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada template yang tersedia di platform.</p>
                        </div>
                    @endforelse
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

        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('template-container');
            const items = Array.from(document.querySelectorAll('.template-item'));
            const btn = document.getElementById('loadMoreBtn');
            const filterBtns = document.querySelectorAll('.filter-btn');
            const categoryItems = document.querySelectorAll('.category-item');
            const toggleCategoriesBtn = document.getElementById('toggleCategoriesBtn');
            
            let visibleCount = 4;
            let currentFilter = 'semua';
            let isShowingAllCategories = false;

            if (toggleCategoriesBtn) {
                toggleCategoriesBtn.addEventListener('click', () => {
                    isShowingAllCategories = !isShowingAllCategories;
                    categoryItems.forEach((item, index) => {
                        if (index >= 3) {
                            item.style.display = isShowingAllCategories ? 'inline-block' : 'none';
                        }
                    });
                    toggleCategoriesBtn.innerHTML = isShowingAllCategories ? '&laquo;' : '&raquo;';
                });
            }

            function updateGrid() {
                let filteredItems = items;
                
                if (currentFilter !== 'semua') {
                    filteredItems = items.filter(item => item.getAttribute('data-category') === currentFilter);
                }
                
                items.forEach(item => item.style.display = 'none');
                
                filteredItems.forEach((item, index) => {
                    if (index < visibleCount) {
                        item.style.display = 'flex';
                    }
                });

                if (btn) {
                    if (filteredItems.length <= 4) {
                        btn.style.display = 'none';
                    } else {
                        btn.style.display = 'inline-block';
                        if (visibleCount >= filteredItems.length) {
                            btn.innerText = "Menampilkan Lebih Sedikit";
                        } else {
                            btn.innerText = "Lihat Lebih Banyak";
                        }
                    }
                }
            }

            filterBtns.forEach(btnFilter => {
                btnFilter.addEventListener('click', () => {
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-white', 'dark:bg-slate-700', 'text-slate-800', 'dark:text-white', 'shadow-sm');
                        b.classList.add('text-slate-500', 'dark:text-slate-400');
                    });
                    
                    btnFilter.classList.remove('text-slate-500', 'dark:text-slate-400');
                    btnFilter.classList.add('bg-white', 'dark:bg-slate-700', 'text-slate-800', 'dark:text-white', 'shadow-sm');
                    
                    currentFilter = btnFilter.getAttribute('data-filter');
                    visibleCount = 4; 
                    
                    updateGrid();
                    container.scrollTo({ left: 0, behavior: 'smooth' });
                });
            });

            if (btn) {
                btn.addEventListener('click', function() {
                    if (btn.innerText.trim() === "Menampilkan Lebih Sedikit") {
                        visibleCount = 4;
                        container.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        visibleCount += 8;
                    }
                    updateGrid();
                });
            }
            
            updateGrid();
        });
    </script>
@endsection