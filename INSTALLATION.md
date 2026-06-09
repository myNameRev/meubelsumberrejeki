# Panduan Instalasi & Konfigurasi

## 📋 Daftar Periksa Sebelum Memulai

- [x] PHP 8.2+
- [x] Composer
- [x] MySQL (via Laragon)
- [x] Code Editor (VS Code)

## 🔧 Langkah-Langkah Instalasi

### 1. Buka Terminal di Folder Proyek

```bash
cd c:\laragon\www\meubelsumberrejeki
```

### 2. Install Dependencies (jika belum)

```bash
composer install
```

### 3. Setup Environment

Jika belum ada file `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meubelsumberrejeki
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrations & Seeding

```bash
php artisan migrate --seed
```

Ini akan:
- Membuat database `meubelsumberrejeki`
- Membuat semua table (users, cache, jobs, categories, products, admins)
- Insert sample data (kategori, produk, admin user)

### 6. Link Storage (jika upload gambar error)

```bash
php artisan storage:link
```

### 7. Jalankan Server

```bash
php artisan serve
```

Output:
```
INFO  Server running on [http://127.0.0.1:8000].
```

## 🌐 Akses Aplikasi

| Bagian | URL | Keterangan |
|--------|-----|-----------|
| **Website Frontend** | http://localhost:8000 | Homepage publik |
| **Kategori** | http://localhost:8000/categories | Daftar kategori |
| **Admin Login** | http://localhost:8000/admin/login | Halaman login |
| **Admin Dashboard** | http://localhost:8000/admin/dashboard | Dashboard admin |

## 🔐 Akun Admin Default

```
Email: admin@meubelsumberrejeki.com
Password: admin123456
```

**⚠️ PENTING**: Ubah password setelah pertama kali login!

## 📁 Struktur Folder Penting

```
meubelsumberrejeki/
├── app/
│   ├── Models/          ← Database models
│   ├── Http/
│   │   └── Controllers/ ← Controller logic
│   └── ...
├── database/
│   ├── migrations/      ← Database schemas
│   └── seeders/         ← Seeding data
├── resources/
│   └── views/           ← View templates (Blade)
├── routes/
│   └── web.php          ← Route definitions
├── storage/
│   └── app/public/      ← Upload folder (images)
├── .env                 ← Environment config
└── ...
```

## 🖼️ Upload Gambar

Gambar akan disimpan di: `storage/app/public/`

Untuk mengakses gambar: `http://localhost:8000/storage/nama-folder/nama-file.jpg`

**Folder kategori**: `categories/`
**Folder produk**: `products/`

## 🐛 Troubleshooting

### Error: "database does not exist"

```bash
# Jalankan ulang migration dengan fresh
php artisan migrate:refresh --seed
```

### Error: "SQLSTATE[HY000] [2002] No such file or directory"

Pastikan MySQL/MariaDB running di Laragon:
1. Buka Laragon
2. Klik tombol "Start All"
3. Cek MySQL status (harus hijau)

### Error: "Class not found" atau "autoload error"

```bash
composer dump-autoload
```

### Error: "CSRF token mismatch"

Clear cache:
```bash
php artisan cache:clear
php artisan config:clear
```

### Upload gambar tidak berfungsi

```bash
# Buat symbolic link ke storage
php artisan storage:link

# Set permission folder storage
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 🔄 Reset Database

Jika ingin memulai dari awal:

```bash
# Hapus semua table dan re-seed
php artisan migrate:refresh --seed

# Atau jika error, gunakan fresh (lebih lengkap)
php artisan migrate:fresh --seed
```

## 📊 Verify Installation

Untuk memastikan semuanya bekerja:

1. **Akses homepage**: http://localhost:8000 ✓
2. **Lihat produk**: http://localhost:8000/categories ✓
3. **Login admin**: http://localhost:8000/admin/login ✓
4. **Akses dashboard**: http://localhost:8000/admin/dashboard ✓

## 📝 File Konfigurasi Penting

### config/app.php
- APP_NAME: "Meubel Sumber Rejeki"
- APP_DEBUG: true (untuk development)

### config/auth.php
- Guards: 'admin' untuk admin authentication
- Providers: 'admins' menggunakan Admin model

### config/filesystems.php
- 'public' disk untuk menyimpan upload

### routes/web.php
- Frontend routes: homepage, kategori, produk
- Admin routes: login, dashboard, CRUD kategori & produk

## 🚀 Production Deployment

Jika ingin deploy ke server:

1. Set `APP_ENV=production` di `.env`
2. Set `APP_DEBUG=false` di `.env`
3. Generate APP_KEY
4. Jalankan migration di server
5. Set proper file permissions
6. Setup `.htaccess` untuk clean URLs
7. Configure SSL certificate

---

✅ **Instalasi Selesai! Sekarang Anda siap menggunakan Meubel Sumber Rejeki!** 🎉
