@extends('user.layouts.app')
@section('title', 'Syarat dan Ketentuan')
@section('content')
<main class="grow relative z-10 bg-white dark:bg-slate-900 pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6 relative z-10 w-full text-slate-700 dark:text-slate-300">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6">Syarat dan Ketentuan</h1>
        <p class="mb-8 text-sm text-slate-500 dark:text-slate-400">Terakhir diperbarui: {{ date('d F Y') }}</p>
        
        <p class="mb-6 text-lg leading-relaxed">Selamat datang di BikinWebsite. Dengan mengakses atau menggunakan platform kami, Anda setuju untuk terikat oleh syarat dan ketentuan berikut ini. Harap membacanya dengan seksama.</p>
        
        <div class="space-y-8">
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">1. Penggunaan Layanan</h3>
                <p class="leading-relaxed">Anda setuju untuk menggunakan platform BikinWebsite hanya untuk tujuan yang sah dan sesuai dengan hukum yang berlaku. Dilarang keras menggunakan platform kami untuk aktivitas ilegal, menyebarkan spam, atau mengunggah konten berbahaya.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">2. Akun Pengguna</h3>
                <p class="leading-relaxed">Anda bertanggung jawab untuk menjaga kerahasiaan informasi akun Anda, termasuk kata sandi. Segala aktivitas yang terjadi di bawah akun Anda adalah tanggung jawab Anda sepenuhnya. Kami berhak membatalkan akun yang kami anggap mencurigakan.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">3. Konten dan Hak Cipta</h3>
                <p class="leading-relaxed">Semua template, aset, dan desain bawaan yang disediakan oleh BikinWebsite adalah hak cipta kami atau mitra kami. Anda diberikan lisensi terbatas untuk menggunakan desain tersebut dalam website Anda sendiri, namun Anda tidak diperkenankan menjual ulang template tersebut secara mentah.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">4. Penghentian Layanan</h3>
                <p class="leading-relaxed">Kami berhak untuk menangguhkan atau menghentikan akses Anda ke platform kapan saja, tanpa pemberitahuan sebelumnya, jika kami menemukan adanya pelanggaran material terhadap syarat dan ketentuan ini.</p>
            </section>
            
            <section>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">5. Perubahan Syarat</h3>
                <p class="leading-relaxed">Kami dapat merevisi syarat dan ketentuan ini dari waktu ke waktu. Pembaruan akan dipublikasikan di halaman ini, dan penggunaan berkelanjutan atas platform setelah perubahan dilakukan merupakan persetujuan Anda terhadap perubahan tersebut.</p>
            </section>
        </div>
    </div>
</main>
@endsection
