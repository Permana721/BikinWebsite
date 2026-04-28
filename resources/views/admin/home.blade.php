@extends('admin.layouts.app')
@section('title', 'Dasbor Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2rem] p-8 sm:p-10 mb-10 shadow-lg shadow-blue-600/20 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-2 relative z-10">Selamat Datang, Admin! 🚀</h1>
        <p class="text-blue-100 text-sm sm:text-base max-w-xl relative z-10">Pantau performa platform, kelola template terbaru, dan tinjau transaksi dari UMKM di seluruh Indonesia hari ini.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-1">45</h3>
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total Template</p>
        </div>

        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-1">{{ number_format($totalUser, 0, ',', '.') }}</h3>
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Pengguna (UMKM)</p>
        </div>

        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-1">892</h3>
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Transaksi Berhasil</p>
        </div>

        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-1">Rp 42.5M</h3>
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total Pendapatan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-1 bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 md:p-8 border border-slate-100 dark:border-slate-700 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Aksi Cepat</h2>
            
            <div class="space-y-4">
                <a href="#" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-500 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 p-2 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="font-semibold text-slate-700 dark:text-slate-200">Tambah Template Baru</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.user') }}" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-500 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-100 dark:bg-purple-900/40 text-purple-600 dark:text-purple-400 p-2 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="font-semibold text-slate-700 dark:text-slate-200">Kelola Data UMKM</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl p-6 md:p-8 border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">Transaksi Terbaru</h2>
                <a href="#" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-sm font-bold text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700">
                            <th class="pb-3 px-2">ID Transaksi</th>
                            <th class="pb-3 px-2">UMKM</th>
                            <th class="pb-3 px-2">Template</th>
                            <th class="pb-3 px-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-slate-50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors">
                            <td class="py-4 px-2 font-semibold text-slate-800 dark:text-slate-200 text-sm">#TRX-0012</td>
                            <td class="py-4 px-2 text-sm text-slate-600 dark:text-slate-400">Kedai Kopi Senja</td>
                            <td class="py-4 px-2 text-sm text-slate-600 dark:text-slate-400">Bite & Delight</td>
                            <td class="py-4 px-2">
                                <span class="px-2.5 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold rounded-md">Berhasil</span>
                            </td>
                        </tr>
                        <tr class="border-b border-slate-50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors">
                            <td class="py-4 px-2 font-semibold text-slate-800 dark:text-slate-200 text-sm">#TRX-0013</td>
                            <td class="py-4 px-2 text-sm text-slate-600 dark:text-slate-400">Butik Bunga</td>
                            <td class="py-4 px-2 text-sm text-slate-600 dark:text-slate-400">Aesthetic Wear</td>
                            <td class="py-4 px-2">
                                <span class="px-2.5 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-bold rounded-md">Menunggu Pembayaran</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection