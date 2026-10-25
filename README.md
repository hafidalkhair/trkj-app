# 🌐 TRKJ Web Management System

Sistem manajemen web berbasis Laravel 11 untuk komunitas atau organisasi, dilengkapi dengan panel admin interaktif menggunakan **FilamentPHP**. Aplikasi ini mendukung manajemen kategori, galeri foto, anggota, dan pesan kontak.

> Dibuat untuk mendukung digitalisasi kegiatan organisasi TRKJ — dengan antarmuka ramah admin dan desain modern.

---

## ✨ Fitur Utama

- 🔐 Login Admin (Filament UI)
- 🗂️ CRUD Kategori Kegiatan
- 📸 Upload & Manajemen Galeri Foto
- 👤 Pengelolaan Anggota
- 📩 Sistem Pesan Kontak (Contact Form)
- ⚙️ Backend modern dengan FilamentPHP

---

## 🛠️ Teknologi yang Digunakan

- Laravel 11
- Filament Admin Panel
- Tailwind CSS
- Vite
- Composer, NPM

---

## 🧾 Struktur Proyek (Singkat)


---

## 🚀 Cara Menjalankan Aplikasi

1. **Clone repositori ini**:
   ```bash
   git clone https://github.com/username/trkj-app.git
   cd trkj-app
   composer install
   npm install && npm run build
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan storage:link
   php artisan serve
   ```

   > ⚠️ **Penting:** jangan lewatkan `php artisan storage:link`. Tanpa perintah ini,
   > folder `public/storage` tidak akan tersambung ke `storage/app/public`, sehingga
   > semua foto yang di-upload lewat panel admin (Kategori, Foto, Anggota) akan
   > menghasilkan error 404 saat ditampilkan di situs.
