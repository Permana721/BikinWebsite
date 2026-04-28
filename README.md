# 🚀 WEB-UKM (Website Builder UMKM)

WEB-UKM adalah sebuah platform *website builder* berbasis Laravel yang dirancang khusus untuk membantu para pelaku UMKM (Usaha Mikro, Kecil, dan Menengah) dalam membuat *landing page* atau profil perusahaan dengan mudah, cepat, dan tanpa perlu keahlian pemrograman (*coding*). 

Platform ini memungkinkan pengguna untuk memilih template HTML profesional dan mengeditnya menggunakan antarmuka *drag-and-drop* yang intuitif.

---

## ✨ Fitur Utama

### 🧑‍💼 Administrator
* **Dasbor Analitik:** Pantau total pendapatan, transaksi berhasil, jumlah template, dan total pengguna secara *real-time*.
* **Manajemen Template:** * Upload *source code* template berformat `.zip`.
    * Sistem multi-upload hingga 5 foto *preview* (thumbnail) untuk setiap template.
    * Toggle Aktif/Nonaktif template dengan mudah.
* **Manajemen Kategori:** Kelola pengelompokan template (Kuliner, Fashion, Jasa, dll).
* **Manajemen User:** Tambah, edit, hapus, dan atur *role* pengguna (Admin/User).

### 🏪 User (UMKM)
* **Katalog Eksplorasi:** Telusuri puluhan template *website* berdasarkan kategori.
* **Manajemen Project:** Lanjutkan proses *editing* dari draft website yang sebelumnya dibuat.
* **Drag & Drop Editor:** Edit teks, gambar, dan tata letak website secara visual (mendukung integrasi *GrapesJS*).
* **Preview & Export:** Pratinjau hasil *website* dan unduh *source code* (HTML/CSS) setelah menyelesaikan simulasi pembayaran.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** PHP 8.x & Laravel Framework
* **Frontend:** HTML5, CSS3, Tailwind CSS (Utility-first CSS)
* **Database:** MySQL / SQLite
* **Ikon & Font:** Heroicons, SVG bawaan, dan Plus Jakarta Sans

---

## ⚙️ Persyaratan Sistem (*Requirements*)

Pastikan komputer/server Anda telah terpasang perangkat lunak berikut:
* [PHP](https://www.php.net/) >= 8.2
* [Composer](https://getcomposer.org/)
* [Node.js & NPM](https://nodejs.org/) (Opsional, untuk kompilasi *asset* lanjutan)
* Database (MySQL)

**Penting:** Karena aplikasi ini menerima *upload* file ZIP template, pastikan Anda telah mengubah konfigurasi pada file `php.ini` server Anda:
```ini
upload_max_filesize = 100M
post_max_size = 100M