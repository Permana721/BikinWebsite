

<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bikin Website Murah Bandung & UMKM') | Bikin Website</title>
    <meta name="description" content="@yield('meta_description', 'Platform pembuatan website murah, cepat, dan profesional. Spesialis bikin website murah Bandung dan UMKM dengan desain premium tanpa koding.')">
    <meta name="keywords" content="Bikin Website, Bikin Website murah bandung, Bikin website murah umkm, Jasa Pembuatan Website, Buat Web Profesional, Website Builder Indonesia">
    <meta name="author" content="Bikin Website">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Bikin Website Murah Bandung & UMKM') | Bikin Website">
    <meta property="og:description" content="@yield('meta_description', 'Platform pembuatan website murah, cepat, dan profesional. Spesialis bikin website murah Bandung dan UMKM dengan desain premium.')">
    <meta property="og:image" content="{{ asset('assets/img/logo/BikinWebsiteLogo.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Bikin Website Murah Bandung & UMKM') | Bikin Website">
    <meta property="twitter:description" content="@yield('meta_description', 'Platform pembuatan website murah, cepat, dan profesional. Spesialis bikin website murah Bandung dan UMKM dengan desain premium.')">
    <meta property="twitter:image" content="{{ asset('assets/img/logo/BikinWebsiteLogo.png') }}">

    <link rel="icon" type="image/png" href="{{asset('assets/img/logo/BikinWebsiteLogo.png')}}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </noscript>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out forwards; }
    </style>
</head>
<body class="bg-[#FAFAFA] dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col relative w-full overflow-x-hidden transition-colors duration-300">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none z-0"></div>
    <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-20 dark:opacity-10 pointer-events-none z-0"></div>

    @include('user.layouts.header')

    <div class="overflow-x-hidden w-full flex flex-col grow pt-20">
        @yield('content')

        @include('user.layouts.footer')
    </div>
</body>
</html>