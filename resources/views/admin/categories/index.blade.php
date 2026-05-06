@extends('admin.layouts.app')
@section('title', 'Kelola Kategori')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Kelola Kategori</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Gunakan kategori untuk mengelompokkan template di dashboard user.</p>
        </div>
        <button onclick="document.getElementById('modal-add').classList.remove('hidden')" 
                class="flex items-center gap-2 px-6 py-3 rounded-2xl font-bold text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/30 text-sm active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
        </button>
    </div>

    {{-- Alert Section --}}
    @if(session('success'))
        <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 mb-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-6 py-4 rounded-3xl text-sm font-medium shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-6 py-4 rounded-3xl text-sm font-medium shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Category Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
        <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-[2rem] p-7 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:shadow-blue-900/5 transition-all group">
            <div class="flex items-start justify-between mb-6">
                <div class="p-4 text-2xl rounded-2xl group-hover:scale-110 transition-transform">
                    {{ $category->icon ?? '' }}
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Total Template</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white">{{ $category->templates_count }}</p>
                </div>
            </div>
            
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-6 tracking-tight">{{ $category->name }}</h3>
            
            <div class="flex gap-3 mt-auto">
                <button onclick='openEditModal({{ json_encode(["id" => $category->id, "name" => $category->name]) }})' 
                        class="flex-1 bg-slate-50 dark:bg-slate-900 hover:bg-blue-600 hover:text-white border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold py-3 rounded-2xl transition-all">
                    Edit Kategori
                </button>
                <button type="button" onclick="openDeleteAlert('{{ route('admin.categories.destroy', $category) }}', '{{ addslashes($category->name) }}')" 
                        class="bg-red-50 dark:bg-red-900/20 hover:bg-red-600 text-red-500 hover:text-white border border-red-100 dark:border-red-900/30 px-4 py-3 rounded-2xl transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-[2.5rem] border border-slate-100 dark:border-slate-700 py-24 text-center shadow-sm">
            <div class="flex flex-col items-center gap-4">
                <p class="font-bold text-slate-500 dark:text-slate-400 text-lg">Belum ada kategori tersedia</p>
                <button onclick="document.getElementById('modal-add').classList.remove('hidden')" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">
                    Tambah kategori pertama sekarang →
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- Modal Add --}}
<div id="modal-add" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[70] flex items-center justify-center p-4 transition-all">
    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-[2.5rem] w-full max-w-md p-10 shadow-2xl transform transition-all">
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 tracking-tight">Tambah Kategori</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="name" placeholder="cth: Kuliner, Fashion, Jasa..." required
                           class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-slate-800 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('modal-add').classList.add('hidden')" 
                        class="flex-1 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 text-slate-700 dark:text-slate-300 py-4 rounded-2xl font-bold transition-all">Batal</button>
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-600/30 transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[70] flex items-center justify-center p-4 transition-all">
    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-[2.5rem] w-full max-w-md p-10 shadow-2xl transform transition-all">
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-8 tracking-tight">Edit Kategori</h2>
        <form id="edit-form" method="POST">
            @csrf @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="edit-name" name="name" required
                           class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-slate-800 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" 
                        class="flex-1 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 text-slate-700 dark:text-slate-300 py-4 rounded-2xl font-bold transition-all">Batal</button>
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-600/30 transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Delete Confirmation --}}
<div id="delete-alert-modal" class="fixed inset-0 z-[80] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeDeleteAlert()"></div>
    <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2.5rem] shadow-2xl max-w-sm w-full mx-6 transform scale-95 transition-all duration-300 border border-slate-100 dark:border-slate-700" id="delete-alert-box">
        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-red-50 dark:bg-red-900/20 rounded-full text-red-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <h3 class="text-2xl font-extrabold text-center text-slate-900 dark:text-white mb-2 tracking-tight">Hapus Kategori?</h3>
        <p class="text-center text-slate-500 dark:text-slate-400 mb-8 text-sm leading-relaxed" id="delete-alert-text"></p>
        <div class="flex gap-4">
            <button onclick="closeDeleteAlert()" class="flex-1 px-4 py-3.5 rounded-2xl font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 transition-all">Batal</button>
            <form id="delete-alert-form" method="POST" class="flex-1 m-0 p-0">
                @csrf @method('DELETE')
                <button type="submit" class="w-full px-4 py-3.5 rounded-2xl font-bold text-white bg-red-600 hover:bg-red-700 text-center transition-colors shadow-lg shadow-red-600/30">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(category) {
        document.getElementById('edit-name').value = category.name;
        document.getElementById('edit-form').action = `/admin/categories/${category.id}`;
        document.getElementById('modal-edit').classList.remove('hidden');
    }

    const deleteAlertModal = document.getElementById('delete-alert-modal');
    const deleteAlertBox = document.getElementById('delete-alert-box');
    const deleteAlertForm = document.getElementById('delete-alert-form');
    const deleteAlertText = document.getElementById('delete-alert-text');

    function openDeleteAlert(actionUrl, categoryName) {
        deleteAlertForm.action = actionUrl;
        deleteAlertText.innerHTML = `Yakin ingin menghapus kategori <b>${categoryName}</b>? Tindakan ini tidak dapat dibatalkan.`;
        deleteAlertModal.classList.remove('hidden');
        setTimeout(() => {
            deleteAlertModal.classList.remove('opacity-0');
            deleteAlertBox.classList.replace('scale-95', 'scale-100');
        }, 10);
    }

    function closeDeleteAlert() {
        deleteAlertModal.classList.add('opacity-0');
        deleteAlertBox.classList.replace('scale-100', 'scale-95');
        setTimeout(() => deleteAlertModal.classList.add('hidden'), 300); 
    }

    window.onclick = function(event) {
        if (event.target.id.startsWith('modal-')) event.target.classList.add('hidden');
    }

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