@extends('admin.layouts.app')
@section('title', 'Data Users')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2 tracking-tight">Manajemen User</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Kelola data pengguna dan Admin di platform ini.</p>
        </div>
        <button onclick="openModal('modal-form')" class="flex items-center gap-2 px-5 py-3 rounded-2xl font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/30 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah User
        </button>
    </div>

    <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        @if(session('success'))
            <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 m-6 p-4 rounded-2xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 m-6 p-4 rounded-2xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 m-6 p-4 rounded-2xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.user') }}" method="GET" id="filterForm" class="p-6 border-b border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative w-full sm:w-96">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." 
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
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-sm font-bold text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700">
                        <th class="pb-4 pt-2 px-6">User Info</th>
                        <th class="pb-4 pt-2 px-4">Role</th>
                        <th class="pb-4 pt-2 px-4">Tier</th>
                        <th class="pb-4 pt-2 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-slate-50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors group">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white text-sm">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-3 py-1 {{ $user->role == 'admin' ? 'bg-blue-100 text-blue-400' : 'bg-purple-100 text-purple-400' }} dark:bg-opacity-20 text-xs font-bold rounded-lg uppercase">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-3 py-1 
                                {{ $user->tier == 'lite' ? 'bg-slate-100 text-slate-500' : ($user->tier == 'pro' ? 'bg-blue-100 text-blue-500' : 'bg-amber-100 text-amber-600') }} 
                                dark:bg-opacity-20 text-xs font-bold rounded-lg uppercase">
                                {{ $user->tier }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if(Auth::id() != $user->id)
                                    <button onclick="openModal('modal-edit-{{ $user->id }}')" class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-xl transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button onclick="openModal('modal-delete-{{ $user->id }}')" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                @else
                                    <span class="text-xs text-slate-400">(Anda)</span>
                                @endif  
                            </div>
                        </td>
                    </tr>

                    <div id="modal-edit-{{ $user->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
                        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('modal-edit-{{ $user->id }}')"></div>
                        <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] w-full max-w-md mx-4 modal-box border border-slate-100 dark:border-slate-700">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Edit Data User</h3>
                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Role</label>
                                    <select name="role" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 outline-none">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Tier</label>
                                    <select name="tier" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 outline-none">
                                        <option value="lite" {{ $user->tier == 'lite' ? 'selected' : '' }}>Lite</option>
                                        <option value="pro" {{ $user->tier == 'pro' ? 'selected' : '' }}>Pro</option>
                                        <option value="elite" {{ $user->tier == 'elite' ? 'selected' : '' }}>Elite</option>
                                    </select>
                                </div>
                                <div class="flex gap-3 pt-4">
                                    <button type="button" onclick="closeModal('modal-edit-{{ $user->id }}')" class="flex-1 px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-700 text-sm font-semibold">Batal</button>
                                    <button type="submit" class="flex-1 px-4 py-3 rounded-2xl bg-blue-600 text-white text-sm font-semibold shadow-lg shadow-blue-600/30">Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="modal-delete-{{ $user->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
                        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('modal-delete-{{ $user->id }}')"></div>
                        <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] max-w-sm w-full mx-4 modal-box text-center border border-slate-100 dark:border-slate-700">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Hapus User?</h3>
                            <p class="text-sm text-slate-500 mb-6">Tindakan ini akan menghapus data <b>{{ $user->name }}</b> secara permanen.</p>
                            <div class="flex gap-3">
                                <button onclick="closeModal('modal-delete-{{ $user->id }}')" class="flex-1 px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-700 text-sm font-semibold">Batal</button>
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-3 rounded-2xl bg-red-600 text-white text-sm font-semibold shadow-lg shadow-red-600/30">Ya, Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center text-sm text-slate-500 dark:text-slate-400">
            @if($users->total() > 0)
                <span>Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data</span>
            @else
                <span>Tidak ada data</span>
            @endif
            
            @if($users->total() >= 5)
            <div class="flex gap-2">
                @if ($users->onFirstPage())
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 opacity-50 cursor-not-allowed">Kembali</button>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700">Kembali</a>
                @endif

                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700">Lanjut</a>
                @else
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 opacity-50 cursor-not-allowed">Lanjut</button>
                @endif
            </div>
            @endif
        </div>

    </div>
</div>

<div id="modal-form" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modal-form')"></div>
    <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] shadow-2xl shadow-blue-900/10 dark:shadow-black/40 w-full max-w-md mx-4 transform scale-95 transition-all duration-300 border border-slate-100 dark:border-slate-700 modal-box">
        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Data User Baru</h3>
        <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
            @csrf   
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama..." 
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm text-slate-800 dark:text-slate-200 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Alamat Email</label>
                <input type="email" name="email" placeholder="email@contoh.com" 
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm text-slate-800 dark:text-slate-200 outline-none transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Peran (Role)</label>
                    <select name="role" 
                        class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm text-slate-800 dark:text-slate-200 outline-none transition-all">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="user">User</option>   
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Tier</label>
                    <select name="tier" 
                        class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm text-slate-800 dark:text-slate-200 outline-none transition-all">
                        <option value="lite" selected>Lite</option>   
                        <option value="pro">Pro</option>
                        <option value="elite">Elite</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                <input type="password" name="password" placeholder="••••••••" 
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm text-slate-800 dark:text-slate-200 outline-none transition-all">
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('modal-form')" class="flex-1 px-4 py-3 rounded-2xl font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors text-sm">Batal</button>
                <button type="submit" class="flex-1 px-4 py-3 rounded-2xl font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-colors text-sm">Simpan Data</button>
            </div>
        </form></div>
</div>

<div id="modal-delete" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modal-delete')"></div>
    
    <div class="relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] shadow-2xl shadow-red-900/10 dark:shadow-black/40 max-w-sm w-full mx-4 transform scale-95 transition-all duration-300 border border-slate-100 dark:border-slate-700 modal-box text-center">
        
        <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 mx-auto mb-4 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        
        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Hapus User?</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Tindakan ini tidak dapat dibatalkan. Semua data terkait pengguna ini akan dihapus permanen.</p>
        
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete')" class="flex-1 px-4 py-3 rounded-2xl font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors text-sm">Batal</button>
            <form action="#" method="POST" class="flex-1">
                <button type="submit" class="w-full px-4 py-3 rounded-2xl font-semibold text-white bg-red-600 hover:bg-red-700 shadow-lg shadow-red-600/30 transition-colors text-sm">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alerts = document.querySelectorAll('.auto-dismiss-alert');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
                
            }, 5000);
        });
    });

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalBox = modal.querySelector('.modal-box');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalBox.classList.remove('scale-95');
            modalBox.classList.add('scale-100');
        }, 10);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalBox = modal.querySelector('.modal-box');
        
        modal.classList.add('opacity-0');
        modalBox.classList.remove('scale-100');
        modalBox.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); 
    }
</script>
@endsection