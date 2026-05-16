@extends('admin.layouts.app')
@section('title', 'Tambah User Baru')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.user') }}" class="p-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
            <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2 tracking-tight">Tambah User Baru</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Tambahkan pengguna atau admin baru ke dalam sistem.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md rounded-[2rem] border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden p-8">
        @if(session('error'))
            <div class="auto-dismiss-alert transition-opacity duration-500 opacity-100 mb-6 p-4 rounded-2xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap..." class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Role</label>
                    <select name="role" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Tier</label>
                    <select name="tier" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                        <option value="lite" {{ old('tier') == 'lite' ? 'selected' : '' }}>Lite</option>
                        <option value="pro" {{ old('tier') == 'pro' ? 'selected' : '' }}>Pro</option>
                        <option value="elite" {{ old('tier') == 'elite' ? 'selected' : '' }}>Elite</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-4 pt-6 mt-6 border-t border-slate-100 dark:border-slate-700">
                <a href="{{ route('admin.user') }}" class="flex-1 text-center px-5 py-3 rounded-2xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">Batal</a>
                <button type="submit" class="flex-1 px-5 py-3 rounded-2xl bg-blue-600 text-white text-sm font-semibold shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-colors">Simpan User Baru</button>
            </div>
        </form>
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
</script>
@endsection
