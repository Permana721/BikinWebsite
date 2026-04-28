<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB-UKM | Website Builder UMKM</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        
        .template-card { transition: all 0.4s ease-in-out; }
    </style>
</head>
<body class="bg-[#FAFAFA] dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col relative overflow-x-hidden transition-colors duration-300">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none z-0"></div>
    <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none z-0"></div>

    <main class="grow relative z-10">
        @include('user.layouts.header')

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
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-700 shadow-xl shadow-blue-600/30 transition-all transform hover:-translate-y-1 text-center">Mulai Desain Sekarang</a>
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
                    
                    <div class="flex gap-2 flex-wrap bg-slate-50 dark:bg-slate-900 p-1.5 rounded-full border border-slate-100 dark:border-slate-700 transition-colors">
                        <button data-filter="semua" class="filter-btn px-5 py-2 bg-white dark:bg-slate-700 text-slate-800 dark:text-white text-sm font-semibold rounded-full shadow-sm transition-all">Semua</button>
                        <button data-filter="kuliner" class="filter-btn px-5 py-2 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all">Kuliner</button>
                        <button data-filter="fashion" class="filter-btn px-5 py-2 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all">Fashion</button>
                        <button data-filter="jasa" class="filter-btn px-5 py-2 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full hover:text-slate-800 dark:hover:text-white transition-all">Jasa</button>
                    </div>
                </div>

                <div id="template-slider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth pb-8 -mx-6 px-6 md:mx-0 md:px-0">
                    
                    <div data-category="kuliner" class="template-card shrink-0 w-[85vw] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] snap-center sm:snap-start group relative bg-[#FAFAFA] dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300">
                        <div class="aspect-[4/3] w-full bg-slate-200 dark:bg-slate-800 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80" alt="Kuliner" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200">KULINER</div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Bite & Delight</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Tema elegan untuk restoran, kafe, atau bisnis catering rumahan.</p>
                            <button class="w-full bg-slate-900 dark:bg-blue-600 text-white py-3 rounded-2xl font-semibold hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                                Gunakan Template
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div data-category="fashion" class="template-card shrink-0 w-[85vw] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] snap-center sm:snap-start group relative bg-[#FAFAFA] dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300">
                        <div class="aspect-[4/3] w-full bg-slate-200 dark:bg-slate-800 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&w=600&q=80" alt="Fashion" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200">FASHION</div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Aesthetic Wear</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Cocok untuk toko baju online, butik, atau rilis koleksi terbaru.</p>
                            <button class="w-full bg-slate-900 dark:bg-blue-600 text-white py-3 rounded-2xl font-semibold hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                                Gunakan Template
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div data-category="jasa" class="template-card shrink-0 w-[85vw] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] snap-center sm:snap-start group relative bg-[#FAFAFA] dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300">
                        <div class="aspect-[4/3] w-full bg-slate-200 dark:bg-slate-800 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" alt="Jasa" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 dark:text-slate-200">JASA</div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Pro Consult</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Desain profesional untuk agensi, konsultan, atau layanan servis.</p>
                            <button class="w-full bg-slate-900 dark:bg-blue-600 text-white py-3 rounded-2xl font-semibold hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                                Gunakan Template
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
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

        @include('user.layouts.footer')
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
            const slider = document.getElementById('template-slider');
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
                            card.style.display = 'block';
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
</body>
</html>