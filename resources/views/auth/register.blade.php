<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - BikinSitus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FAFAFA] dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex items-center justify-center relative overflow-hidden transition-colors duration-300 py-10">

    <div class="absolute top-[-5%] right-[-5%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 dark:opacity-20 pointer-events-none"></div>
    <div class="absolute bottom-[-5%] left-[-5%] w-[500px] h-[500px] bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="flex justify-center mb-6">
            <a href="/" class="text-3xl font-extrabold tracking-tighter text-blue-600 flex items-center gap-2">
                <img src="{{ asset('assets/img/logo/BikinSitusLogo.png') }}" alt="Logo BikinSitus" class="h-10 w-auto">
                <span>Bikin<span class="font-light text-3xl">Situs</span></span>
            </a>
        </div>

        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-[2rem] p-8 shadow-2xl border border-white/20 dark:border-slate-700/50">
            <h2 class="text-2xl font-bold mb-2 text-slate-900 dark:text-white">Buat Akun Baru </h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">Mulai digitalisasi bisnismu hari ini.</p>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Nama Anda</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama anda" 
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Email Bisnis</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" 
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                    @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="Minimal 8 karakter" 
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                    @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Ulangi Kata Sandi</label>
                    <input type="password" name="password_confirmation" required placeholder="Ketik ulang sandi" 
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-8 font-medium">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>