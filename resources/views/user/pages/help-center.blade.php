@extends('user.layouts.app')
@section('title', 'Pusat Bantuan')
@section('content')
<main class="grow relative z-10 bg-[#FAFAFA] dark:bg-slate-900 pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6 relative z-10 w-full flex flex-col lg:flex-row gap-8 lg:gap-12">
        
        <!-- Sidebar -->
        <aside class="w-full lg:w-1/4 shrink-0">
            <div class="sticky top-28 bg-white dark:bg-slate-800/80 p-6 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm">
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white mb-6">Pusat Bantuan</h2>
                
                <nav class="space-y-1" id="help-sidebar">
                    <a href="#" data-target="all" class="category-link active flex items-center justify-between px-4 py-3 text-sm font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 rounded-xl transition-colors group">
                        Semua Topik
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="#" data-target="getting-started" class="category-link flex items-center justify-between px-4 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700/50 rounded-xl transition-colors group">
                        Memulai dengan BikinWebsite
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    
                    <a href="#" data-target="creating-website" class="category-link flex items-center justify-between px-4 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700/50 rounded-xl transition-colors group">
                        Membuat Website
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="#" data-target="account-billing" class="category-link flex items-center justify-between px-4 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700/50 rounded-xl transition-colors group">
                        Akun & Tagihan
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    
                    <a href="#" data-target="domain" class="category-link flex items-center justify-between px-4 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700/50 rounded-xl transition-colors group">
                        Menghubungkan Domain
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <!-- Dropdown Item -->
                    <div class="pt-2">
                        <button id="btn-more-help" class="w-full flex items-center justify-between px-4 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-xl transition-colors group">
                            Butuh bantuan lebih?
                            <svg class="w-4 h-4 transform transition-transform" id="icon-more-help" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div id="menu-more-help" class="mt-2 ml-6 pl-4 border-l-2 border-slate-100 dark:border-slate-700 space-y-1">
                            <a href="#" data-target="technical" class="category-link block px-3 py-2.5 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors">
                                Memecahkan masalah teknis
                            </a>
                            <a href="#" data-target="known-issues" class="category-link block px-3 py-2.5 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors">
                                Masalah yang Diketahui
                            </a>
                            <a href="#" data-target="about" class="category-link block px-3 py-2.5 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors">
                                Tentang BikinWebsite
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 bg-white dark:bg-slate-800/80 rounded-3xl p-8 md:p-10 border border-slate-100 dark:border-slate-700 shadow-sm min-h-[600px] flex flex-col">
            <h1 id="page-title" class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-4">Bagaimana kami bisa membantu Anda?</h1>
            <p id="page-desc" class="text-slate-500 dark:text-slate-400 mb-8 text-lg">Temukan jawaban untuk semua pertanyaan tentang fitur, pembayaran, dan pembuatan website.</p>
            
            <div class="relative mb-12 shrink-0">
                <input type="text" id="search-input" placeholder="Cari artikel bantuan, panduan, atau FAQ..." class="w-full bg-[#FAFAFA] dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-white rounded-2xl py-4 pl-14 pr-6 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base font-medium placeholder-slate-400">
                <svg class="w-6 h-6 text-slate-400 absolute left-5 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <!-- Empty State (Hidden by default) -->
            <div id="empty-state" class="hidden flex-col items-center justify-center py-12 text-center grow">
                <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Tidak ditemukan hasil</h3>
                <p class="text-slate-500 dark:text-slate-400">Kami tidak dapat menemukan artikel yang sesuai dengan pencarian Anda. Coba gunakan kata kunci lain.</p>
            </div>

            <div id="faq-container" class="space-y-4 grow">
                
                <!-- GETTING STARTED -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="getting-started" data-title="Bagaimana cara mulai membuat website pertama saya?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Bagaimana cara mulai membuat website pertama saya?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        Anda dapat memulai dengan mengunjungi halaman <strong>Templates</strong>. Pilih desain yang paling sesuai dengan kebutuhan Anda, klik "Edit", lalu Anda akan diarahkan ke editor visual kami. Di sana, Anda dapat mengganti teks, gambar, dan warna secara instan.
                    </div>
                </div>

                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="getting-started" data-title="Apa itu BikinWebsite?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Apa itu BikinWebsite?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        BikinWebsite adalah platform pembuat website instan yang dirancang agar siapa saja dapat membuat situs web profesional tanpa perlu memiliki keahlian coding atau desain tingkat lanjut.
                    </div>
                </div>

                <!-- CREATING WEBSITE -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="creating-website" data-title="Bagaimana cara mengganti template setelah website dibuat?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Bagaimana cara mengganti template setelah website dibuat?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        Saat ini, untuk mengganti template Anda perlu membuat Project baru dari halaman Templates. Setiap template memiliki struktur tata letaknya masing-masing untuk memastikan desain tetap rapi dan profesional.
                    </div>
                </div>

                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="creating-website" data-title="Bagaimana cara menambahkan atau mengubah gambar?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Bagaimana cara menambahkan atau mengubah gambar?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        Di dalam editor, cukup klik ganda (double-click) pada gambar apapun yang ingin Anda ubah. Jendela pengunggah gambar akan muncul, memungkinkan Anda memilih gambar dari komputer Anda.
                    </div>
                </div>

                <!-- ACCOUNT & BILLING -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="account-billing" data-title="Bagaimana cara melakukan pembayaran atau upgrade ke paket Premium?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Bagaimana cara melakukan pembayaran atau upgrade ke paket Premium?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        Untuk meningkatkan layanan, masuk ke menu Profil Anda lalu cari opsi langganan. Kami mendukung berbagai metode pembayaran lokal maupun internasional untuk memudahkan Anda.
                    </div>
                </div>

                <!-- DOMAIN -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="domain" data-title="Apakah saya bisa menggunakan nama domain saya sendiri? (namasaya.com)">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Apakah saya bisa menggunakan nama domain saya sendiri? (namasaya.com)</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        Tentu saja! Jika Anda berlangganan paket Pro atau Elite, Anda dapat mengarahkan (pointing) nama domain yang sudah Anda miliki ke server kami menggunakan pengaturan DNS (CNAME/A Record).
                    </div>
                </div>

                <!-- TECHNICAL -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="technical" data-title="Saya mengalami kendala saat publish website, apa yang harus dilakukan?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Saya mengalami kendala saat publish website, apa yang harus dilakukan?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        Cobalah untuk memuat ulang halaman editor dan memastikan Anda memiliki koneksi internet yang stabil. Jika masalah terus berlanjut, hubungi tim dukungan kami melalui kontak di bawah.
                    </div>
                </div>

                <!-- KNOWN ISSUES -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="known-issues" data-title="Tidak dapat memuat pratinjau mobile di peramban lama">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Tidak dapat memuat pratinjau mobile di peramban lama</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        (Update {{ date('Y') }}) Kami menyadari adanya kendala saat membuka editor responsif menggunakan peramban (browser) lawas. Sangat disarankan untuk memperbarui Google Chrome atau Mozilla Firefox Anda ke versi terbaru.
                    </div>
                </div>

                <!-- ABOUT -->
                <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm transition-all" data-category="about" data-title="Siapa di balik BikinWebsite?">
                    <button class="faq-btn w-full flex items-center justify-between px-6 py-5 bg-[#FAFAFA] dark:bg-slate-800/80 text-left font-bold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <span>Siapa di balik BikinWebsite?</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-content hidden px-6 py-5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-t border-slate-200 dark:border-slate-700 leading-relaxed">
                        BikinWebsite merupakan karya inovatif yang lahir dari semangat wirausaha (<i>entrepreneurship</i>) mahasiswa Informatika <strong>Universitas Informatika dan Bisnis Indonesia (UNIBI)</strong>. Platform ini bukan sekadar solusi teknologi, melainkan wujud nyata dari visi universitas dalam mencetak <i>technopreneur</i> muda yang tangguh untuk mendorong digitalisasi UMKM dan bisnis di Indonesia.
                    </div>
                </div>

            </div>
            
            <div id="contact-banner" class="mt-12 shrink-0 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-3xl p-8 flex flex-col sm:flex-row items-center gap-6 border border-blue-100 dark:border-blue-800/50">
                <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Masih belum menemukan jawaban?</h4>
                    <p class="text-slate-600 dark:text-slate-400 mb-5">Tim dukungan ahli kami siap membantu Anda menyelesaikan kendala kapan saja.</p>
                    <a href="https://wa.me/628978657617?text=Halo%20admin%2C%20saya%20butuh%20bantuan" target="_blank" rel="noopener noreferrer" class="inline-block bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition-transform transform hover:-translate-y-0.5 shadow-lg shadow-blue-600/30">
                        Hubungi Tim Support
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const categoryLinks = document.querySelectorAll('.category-link');
        const faqItems = document.querySelectorAll('.faq-item');
        const searchInput = document.getElementById('search-input');
        const pageTitle = document.getElementById('page-title');
        const pageDesc = document.getElementById('page-desc');
        const emptyState = document.getElementById('empty-state');
        const btnMoreHelp = document.getElementById('btn-more-help');
        const menuMoreHelp = document.getElementById('menu-more-help');
        const iconMoreHelp = document.getElementById('icon-more-help');

        // Accordion functionality
        document.querySelectorAll('.faq-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const content = btn.nextElementSibling;
                const icon = btn.querySelector('.faq-icon');
                
                // Toggle current
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180', 'text-blue-600');
                    btn.classList.add('text-blue-600');
                } else {
                    content.classList.add('hidden');
                    icon.classList.remove('rotate-180', 'text-blue-600');
                    btn.classList.remove('text-blue-600');
                }
            });
        });

        // More Help Dropdown Toggle
        btnMoreHelp.addEventListener('click', (e) => {
            e.preventDefault();
            menuMoreHelp.classList.toggle('hidden');
            iconMoreHelp.classList.toggle('rotate-180');
        });

        // Category Filtering
        categoryLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Update active classes for sidebar
                categoryLinks.forEach(l => {
                    l.classList.remove('active', 'font-bold', 'text-blue-600', 'dark:text-blue-400', 'bg-blue-50', 'dark:bg-blue-900/30');
                    l.classList.add('font-semibold', 'text-slate-700', 'dark:text-slate-300');
                });
                link.classList.add('active', 'font-bold', 'text-blue-600', 'dark:text-blue-400', 'bg-blue-50', 'dark:bg-blue-900/30');
                link.classList.remove('font-semibold', 'text-slate-700', 'dark:text-slate-300');

                const targetCategory = link.getAttribute('data-target');
                const categoryText = link.textContent.trim();
                
                // Reset search when changing category
                searchInput.value = '';

                // Update Header
                if(targetCategory === 'all') {
                    pageTitle.textContent = 'Bagaimana kami bisa membantu Anda?';
                    pageDesc.textContent = 'Temukan jawaban untuk semua pertanyaan tentang fitur, pembayaran, dan pembuatan website.';
                } else {
                    pageTitle.textContent = categoryText;
                    pageDesc.textContent = 'Artikel dan panduan terkait ' + categoryText.toLowerCase();
                }

                // Filter Items
                let visibleCount = 0;
                faqItems.forEach(item => {
                    const itemCat = item.getAttribute('data-category');
                    if (targetCategory === 'all' || targetCategory === itemCat) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Toggle empty state
                if(visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                    emptyState.classList.add('flex');
                } else {
                    emptyState.classList.add('hidden');
                    emptyState.classList.remove('flex');
                }
            });
        });

        // Realtime Search Filtering
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            let visibleCount = 0;
            
            // Unselect categories in sidebar when typing
            if (query.length > 0) {
                categoryLinks.forEach(l => {
                    l.classList.remove('active', 'font-bold', 'text-blue-600', 'dark:text-blue-400', 'bg-blue-50', 'dark:bg-blue-900/30');
                    l.classList.add('font-semibold', 'text-slate-700', 'dark:text-slate-300');
                });
                pageTitle.textContent = 'Hasil Pencarian';
                pageDesc.textContent = 'Menampilkan hasil untuk: "' + query + '"';
            } else {
                // If empty, click the 'All' category to reset
                document.querySelector('[data-target="all"]').click();
                return;
            }

            faqItems.forEach(item => {
                const title = item.getAttribute('data-title').toLowerCase();
                const content = item.querySelector('.faq-content').textContent.toLowerCase();
                
                if (title.includes(query) || content.includes(query)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if(visibleCount === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            } else {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            }
        });
    });
</script>
@endsection
