@extends('admin.layouts.app')
@section('title', 'Tambah Template')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow animate-slide-up">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.templates.index') }}" class="p-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Tambah Template Baru</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Upload file ZIP template dan minimal 3 foto preview untuk pengguna</p>
        </div>
    </div>
    @if($errors->any())
        <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 text-red-700 dark:text-red-400 px-6 py-4 rounded-3xl text-sm shadow-sm">
            <div class="font-bold mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Terdapat Kesalahan:
            </div>
            <ul class="list-disc list-inside space-y-1 ml-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md border border-slate-100 dark:border-slate-700 rounded-3xl p-6 md:p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Informasi Template
                    </h2>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Template <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="cth: Bite & Delight - Restoran" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl px-4 py-3 text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder:text-slate-400 dark:placeholder:text-slate-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                            <select name="category_id" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl px-4 py-3 text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if($categories->isEmpty())
                                <p class="text-amber-600 dark:text-amber-400 text-xs font-medium mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Belum ada kategori. <a href="{{ route('admin.categories.index') }}" class="underline hover:text-amber-700 dark:hover:text-amber-300">Tambah kategori dulu →</a>
                                </p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Deskripsi</label>
                            <textarea name="description" rows="4" placeholder="Jelaskan secara singkat kegunaan template ini..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl px-4 py-3 text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder:text-slate-400 dark:placeholder:text-slate-500 resize-none">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md border border-slate-100 dark:border-slate-700 rounded-3xl p-6 md:p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        File Source Code (ZIP) <span class="text-red-500">*</span>
                    </h2>
                    <label for="zip_file" class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 rounded-2xl py-12 px-6 cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all group" id="zip-drop-area">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40 transition-all mb-2">
                            <svg class="w-8 h-8 text-slate-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Klik untuk upload atau drag and drop</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Hanya mendukung format .ZIP (Maks. 50MB)</p>
                        </div>
                        <div id="zip-filename" class="hidden mt-4 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-sm font-semibold rounded-xl flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span></span>
                        </div>
                        <input type="file" name="zip_file" id="zip_file" accept=".zip" class="hidden" required>
                    </label>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md border border-slate-100 dark:border-slate-700 rounded-3xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Foto Website <span class="text-red-500">*</span>
                    </h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">Wajib upload 1 foto untuk preview.</p>
                    <div class="grid grid-cols-1 gap-3">
                        <label for="photo_1" class="cursor-pointer block w-full aspect-[21/9]">
                            <div id="preview-container-1" class="w-full h-full bg-slate-50 dark:bg-slate-900/50 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-2xl flex items-center justify-center hover:border-blue-500 dark:hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all overflow-hidden relative group">
                                <div id="placeholder-1" class="flex flex-col items-center gap-2 text-slate-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors p-2 text-center">
                                    <div class="p-2 bg-slate-200 dark:bg-slate-800 rounded-full group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <span class="text-xs font-semibold block">Foto Preview <span class="text-red-500">*</span></span>
                                </div>
                                <img id="img-1" src="" alt="Preview" class="w-full h-full object-cover hidden absolute inset-0 z-10">
                                <div id="overlay-1" class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                    <span class="text-white font-semibold text-[10px] bg-slate-900/80 px-3 py-1.5 rounded-full">Ganti</span>
                                </div>
                            </div>
                            <input type="file" name="photos" id="photo_1" accept="image/*" class="hidden" required>
                        </label>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800/80 backdrop-blur-md border border-slate-100 dark:border-slate-700 rounded-3xl p-6 shadow-sm flex flex-col gap-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-2xl font-bold text-sm shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-0.5 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Template
                    </button>
                    <a href="{{ route('admin.templates.index') }}" class="w-full text-center py-3.5 rounded-2xl text-slate-600 dark:text-slate-400 font-semibold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors border border-transparent hover:border-slate-200 dark:hover:border-slate-600">
                        Batal & Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
for (let i = 1; i <= 1; i++) {
    const input = document.getElementById('photo_' + i);
    const img = document.getElementById('img-' + i);
    const placeholder = document.getElementById('placeholder-' + i);
    const overlay = document.getElementById('overlay-' + i);
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
            img.src = ev.target.result;
            img.classList.remove('hidden');
            placeholder.classList.add('hidden');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        };
        reader.readAsDataURL(file);
    });
}
const zipInput = document.getElementById('zip_file');
const zipFilenameDiv = document.getElementById('zip-filename');
const zipFilenameText = zipFilenameDiv.querySelector('span');
zipInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) {
        zipFilenameDiv.classList.add('hidden');
        return;
    }
    zipFilenameText.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
    zipFilenameDiv.classList.remove('hidden');
});
</script>
@endsection