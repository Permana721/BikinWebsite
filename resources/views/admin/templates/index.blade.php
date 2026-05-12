@extends('admin.layouts.app')
@section('title', 'Kelola Template')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Kelola Template</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage semua template yang tersedia di platform</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            <a href="{{ route('admin.templates.create') }}"
                class="inline-flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-2xl text-sm font-semibold transition-colors shadow-sm shadow-blue-600/20 w-full sm:w-auto whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Template
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 text-green-700 dark:text-green-400 px-4 py-3 rounded-2xl text-sm font-medium">
            ✓ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 text-red-700 dark:text-red-400 px-4 py-3 rounded-2xl text-sm font-medium">
            ✕ {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <form action="{{ route('admin.templates.index') }}" method="GET" id="filterForm" class="p-6 border-b border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative w-full sm:w-96">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / deskripsi template..." 
                    class="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-blue-500 text-sm transition-all text-slate-800 dark:text-slate-200">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            <select name="role" onchange="document.getElementById('filterForm').submit()" 
                    class="px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-blue-500 text-sm text-slate-600 dark:text-slate-300">
                <option value="">Semua Peran</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </form>
        <div class="overflow-x-auto p-2">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="text-sm font-bold text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700">
                        <th class="pb-4 pt-2 px-6">Template</th>
                        <th class="pb-4 pt-2 px-4">Kategori</th>
                        <th class="pb-4 pt-2 px-4">Status</th>
                        <th class="pb-4 pt-2 px-4">Ditambahkan</th>
                        <th class="pb-4 pt-2 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($templates as $template)
                    <tr class="border-b border-slate-50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors group">
                        
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                @php
                                    $thumbnailUrl = $template->photos ? asset('storage/' . $template->photos) : '';
                                @endphp
                                
                                @if($thumbnailUrl)
                                    <img src="{{ $thumbnailUrl }}"
                                         alt="{{ $template->name }}"
                                         class="w-16 h-12 object-cover rounded-xl bg-slate-100 dark:bg-slate-700 shrink-0 cursor-pointer hover:opacity-80 transition-opacity shadow-sm"
                                         onclick="openImageModal('{{ $thumbnailUrl }}', '{{ addslashes($template->name) }}')">
                                @else
                                    <div class="w-16 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 shrink-0 flex items-center justify-center text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-slate-100 text-sm">{{ $template->name }}</div>
                                    <div class="text-slate-500 dark:text-slate-400 text-xs mt-0.5 max-w-[200px] truncate">{{ $template->description }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1.5 bg-slate-100 dark:bg-slate-700/50 text-slate-700 dark:text-slate-300 text-xs font-semibold px-3 py-1.5 rounded-xl">
                                {{ $template->category->icon ?? '' }} {{ $template->category->name }}
                            </span>
                        </td>

                        <td class="py-4 px-4">
                            <form action="{{ route('admin.templates.toggle', $template) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition-colors
                                    {{ $template->is_active
                                        ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/50'
                                        : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }}">
                                    {{ $template->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>

                        <td class="py-4 px-4 text-sm text-slate-500 dark:text-slate-400 font-medium whitespace-nowrap">
                            {{ $template->created_at->format('d M Y') }}
                        </td>

                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.templates.edit', $template) }}"
                                    class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-xl transition-colors" title="Edit Template">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.templates.destroy', $template) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus template ini? File ZIP dan thumbnail akan ikut terhapus.')" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl transition-colors" title="Hapus Template">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-full mb-2">
                                    <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                                    </svg>
                                </div>
                                
                                @if(request('search'))
                                    <p class="font-medium text-slate-500 dark:text-slate-400">Tidak ada template yang cocok dengan pencarian "<span class="font-bold text-slate-700 dark:text-slate-300">{{ request('search') }}</span>".</p>
                                    <a href="{{ route('admin.templates.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-semibold mt-1">
                                        Reset Pencarian →
                                    </a>
                                @else
                                    <p class="font-medium text-slate-500 dark:text-slate-400">Belum ada template yang ditambahkan.</p>
                                    <a href="{{ route('admin.templates.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-semibold mt-1">
                                        Tambah template pertama →
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-slate-500 dark:text-slate-400">
            @if($templates->total() > 0)
                <span>Menampilkan {{ $templates->firstItem() }} - {{ $templates->lastItem() }} dari {{ $templates->total() }} data</span>
            @else
                <span>Tidak ada data</span>
            @endif
            
            @if($templates->total() >= 5)
            <div class="flex gap-2">
                @if ($templates->onFirstPage())
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 opacity-50 cursor-not-allowed bg-slate-50 dark:bg-slate-800">Kembali</button>
                @else
                    <a href="{{ $templates->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">Kembali</a>
                @endif

                @if ($templates->hasMorePages())
                    <a href="{{ $templates->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">Lanjut</a>
                @else
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 opacity-50 cursor-not-allowed bg-slate-50 dark:bg-slate-800">Lanjut</button>
                @endif
            </div>
            @endif
        </div>
    </div>

</div>

<div id="image-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-slate-900/90 backdrop-blur-sm transition-opacity" onclick="closeImageModal()"></div>
    <div class="relative z-10 max-w-5xl w-full mx-4 flex flex-col items-center transform scale-95 transition-transform duration-300" id="image-modal-content">
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-slate-400 hover:text-white transition-colors p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="modal-image-src" src="" alt="Full screen preview" class="w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl">
        <p id="modal-image-title" class="text-white mt-4 font-semibold text-lg tracking-wide"></p>
    </div>
</div>

<script>
    const imageModal = document.getElementById('image-modal');
    const imageModalContent = document.getElementById('image-modal-content');
    const modalImageSrc = document.getElementById('modal-image-src');
    const modalImageTitle = document.getElementById('modal-image-title');

    function openImageModal(imgSrc, title) {
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
        const alerts = document.querySelectorAll('.auto-dismiss-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => alert.style.display = 'none', 500); 
            }, 3000);
        });
    });
</script>
@endsection