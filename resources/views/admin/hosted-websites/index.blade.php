@extends('admin.layouts.app')
@section('title', 'Website Hosting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2 tracking-tight">Website Terhosting</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Pantau daftar website pengguna yang saat ini sedang online (dipublish).</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <form action="{{ route('admin.hosted-websites') }}" method="GET" id="filterForm" class="p-6 border-b border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative w-full sm:w-96">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama project, domain, atau pengguna..." 
                    class="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-blue-500 text-sm transition-all text-slate-800 dark:text-slate-200">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <button type="submit" class="hidden">Cari</button>
        </form>

        <div class="overflow-x-auto p-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-sm font-bold text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700">
                        <th class="pb-4 pt-2 px-6">Domain / URL</th>
                        <th class="pb-4 pt-2 px-4">Project Name</th>
                        <th class="pb-4 pt-2 px-4">Pengguna</th>
                        <th class="pb-4 pt-2 px-4">Template</th>
                        <th class="pb-4 pt-2 px-4">Terakhir Diperbarui</th>
                        <th class="pb-4 pt-2 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($websites as $website)
                    @php
                        $domain = env('MAIN_DOMAIN', 'bisite.web.id');
                        $fullUrl = 'http://' . $website->subdomain . '.' . $domain;
                    @endphp
                    <tr class="border-b border-slate-50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors group">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </div>
                                <div>
                                    @if($website->user->status === 'banned')
                                        <span class="font-bold text-red-500 dark:text-red-400 text-sm flex items-center gap-2 line-through opacity-70" title="Dinonaktifkan karena akun {{ $website->user->status }}">
                                            {{ $website->subdomain }}.{{ $domain }}
                                        </span>
                                        <span class="text-[10px] font-bold px-2 py-0.5 bg-red-100 text-red-600 rounded-md uppercase tracking-wider mt-1 inline-block">Dinonaktifkan</span>
                                    @else
                                        <a href="{{ $fullUrl }}" target="_blank" class="font-bold text-blue-600 dark:text-blue-400 hover:underline text-sm flex items-center gap-1">
                                            {{ $website->subdomain }}.{{ $domain }}
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-sm font-semibold text-slate-800 dark:text-slate-200">
                            {{ $website->name ?? 'Untitled Project' }}
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-sm text-slate-800 dark:text-slate-200">{{ $website->user->name ?? 'N/A' }}</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">({{ $website->user->email ?? 'N/A' }})</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $website->template->name ?? 'N/A' }}
                        </td>
                        <td class="py-4 px-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $website->updated_at->diffForHumans() }}
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if($website->user->status === 'banned')
                                    <button disabled class="p-2 text-slate-300 dark:text-slate-600 cursor-not-allowed rounded-xl" title="Website dinonaktifkan">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                    </button>
                                @else
                                    <a href="{{ $fullUrl }}" target="_blank" class="p-2 text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 hover:bg-slate-100 dark:hover:bg-slate-700/50 rounded-xl transition-colors" title="Kunjungi Website">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-500 dark:text-slate-400">
                                <svg class="w-12 h-12 mb-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                <p class="text-sm font-medium">Belum ada website yang dipublish.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center text-sm text-slate-500 dark:text-slate-400">
            @if($websites->total() > 0)
                <span>Menampilkan {{ $websites->firstItem() }} - {{ $websites->lastItem() }} dari {{ $websites->total() }} data</span>
            @else
                <span>Tidak ada data</span>
            @endif
            
            @if($websites->total() >= 10)
            <div class="flex gap-2">
                @if ($websites->onFirstPage())
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 opacity-50 cursor-not-allowed">Kembali</button>
                @else
                    <a href="{{ $websites->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700">Kembali</a>
                @endif

                @if ($websites->hasMorePages())
                    <a href="{{ $websites->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700">Lanjut</a>
                @else
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 opacity-50 cursor-not-allowed">Lanjut</button>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
