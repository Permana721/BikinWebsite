@extends('user.layouts.app')
@section('title', 'Kebijakan Privasi')
@section('content')
<main class="grow relative z-10 bg-white dark:bg-slate-900 pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6 relative z-10 w-full text-slate-700 dark:text-slate-300">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6">Kebijakan Privasi</h1>
        <p class="mb-8 text-sm text-slate-500 dark:text-slate-400">Terakhir diperbarui: {{ date('d F Y') }}</p>
        
        <p class="mb-6 text-lg leading-relaxed">Di BikinWebsite, privasi Anda sangat penting bagi kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan platform kami.</p>
        
        <div class="space-y-8">
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">1. Informasi yang Kami Kumpulkan</h3>
                <p class="leading-relaxed">Kami dapat mengumpulkan informasi pribadi yang Anda berikan secara langsung kepada kami, seperti nama, alamat email, dan kata sandi saat Anda mendaftar akun. Kami juga mengumpulkan informasi teknis secara otomatis, seperti alamat IP, perangkat yang digunakan, dan riwayat penjelajahan di platform kami.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">2. Penggunaan Informasi</h3>
                <p class="leading-relaxed">Informasi yang kami kumpulkan digunakan untuk mengoperasikan, memelihara, dan meningkatkan kualitas platform kami. Kami juga menggunakannya untuk berkomunikasi dengan Anda mengenai pembaruan layanan, dukungan pelanggan, dan memberitahukan tentang fitur terbaru kami.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">3. Keamanan Data</h3>
                <p class="leading-relaxed">Kami menerapkan berbagai langkah keamanan teknis dan organisasional yang ketat untuk melindungi informasi pribadi Anda dari akses, pengubahan, atau pengungkapan yang tidak sah. Walaupun begitu, tidak ada transmisi data elektronik yang sepenuhnya kebal terhadap risiko keamanan.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">4. Berbagi Informasi dengan Pihak Ketiga</h3>
                <p class="leading-relaxed">Kami tidak akan menjual belikan atau menyewakan informasi pribadi Anda kepada pihak ketiga manapun. Kami hanya membagikan data kepada mitra layanan terpercaya (seperti penyedia layanan komputasi awan) yang membantu kami menjalankan platform dengan kewajiban kerahasiaan yang mengikat.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">5. Hak Privasi Anda</h3>
                <p class="leading-relaxed">Anda memiliki hak penuh untuk mengakses, memperbarui, membatasi penggunaan, atau menghapus informasi pribadi Anda yang tersimpan pada sistem kami. Pengaturan tersebut dapat diakses melalui Dasbor Profil Anda atau dengan menghubungi tim dukungan kami secara langsung.</p>
            </section>
        </div>
    </div>
</main>
@endsection
