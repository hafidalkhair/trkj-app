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
    npm install && npm run dev
    cp .env.example .env
    php artisan key:generate
    php artisan serve
