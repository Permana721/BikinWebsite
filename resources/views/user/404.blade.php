@extends('user.layouts.app')
@section('title', '404 - Halaman Tidak Ditemukan')
@section('content')
<main class="grow relative z-10 overflow-hidden">
    <section class="relative pt-24 pb-20 md:pt-32 md:pb-32 lg:min-h-[85vh] flex items-center">
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[10%] left-[5%] w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 animate-pulse"></div>
            <div class="absolute bottom-[20%] right-[10%] w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6 leading-[1.15]">
                        Ups! <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600">Halaman Hilang.</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-lg md:text-xl mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Maaf, kami tidak dapat menemukan halaman yang Anda cari. Mungkin URL yang Anda masukkan salah atau halaman telah dipindahkan.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ url('/') }}" class="w-full sm:w-auto bg-blue-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Kembali ke Beranda
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 relative w-full max-w-2xl lg:max-w-none">
                    <div class="relative rounded-2xl overflow-hidden ">
                        <img src="{{ asset('assets/img/404.png') }}" alt="404 Not Found" class="w-full h-auto">
                    </div>
                    <div class="hidden md:flex absolute -left-12 bottom-12 bg-white/90 dark:bg-slate-800/90 backdrop-blur-md p-4 rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">Tidak dapat menemukan halaman yang anda cari</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Status: 404 Not Found</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
