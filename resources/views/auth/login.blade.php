<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - BikinSitus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FAFAFA] dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex items-center justify-center relative overflow-hidden transition-colors duration-300">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 dark:opacity-20 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-30 dark:opacity-20 pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="flex justify-center mb-8">
            <a href="/" class="text-3xl font-extrabold tracking-tighter text-blue-600 flex items-center gap-2">
                <img src="{{ asset('assets/img/logo/BikinSitusLogo.png') }}" alt="Logo BikinSitus" class="h-10 w-auto">
                <span>Bikin<span class="font-light text-3xl">Situs</span></span>
            </a>
        </div>

        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-[2rem] p-8 shadow-2xl border border-white/20 dark:border-slate-700/50">
            <h2 class="text-2xl font-bold mb-2 text-slate-900 dark:text-white">Selamat Datang Kembali</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Silakan masuk ke akun Bikin Situs Anda.</p>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 p-3 rounded-xl text-sm font-medium border border-red-100 dark:border-red-800">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Email Anda</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Kata Sandi</label>
                        <a href="#" class="text-xs font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">Lupa sandi?</a>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••" 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-0.5">
                        Masuk
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-8 font-medium">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</body>
</html>