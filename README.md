# Meubel Sumber Rejeki - Toko Meubel Online

Selamat datang ke **Meubel Sumber Rejeki**, toko meubel online profesional yang dibangun dengan Laravel 13 dan Composer. Sistem ini menyediakan pengalaman belanja yang sempurna dengan desain modern menggunakan tema warna putih, cream, dan coklat.

## 🎯 Fitur Utama

### 1. **Landing Page**
- Hero section yang menarik dengan call-to-action
- Menampilkan produk unggulan dan terbaru
- Carousel kategori produk
- Informasi tentang toko
- Section kontak dan lokasi

### 2. **Katalog Produk**
- Lihat semua produk dengan kategori
- Filter produk berdasarkan kategori
- Detail produk lengkap dengan spesifikasi
- Informasi harga dan stok
- Produk terkait di halaman detail

### 3. **Sistem Admin (CRUD)**
- **Dashboard Admin**: Statistik dan informasi produk terbaru
- **Manajemen Kategori**: Create, Read, Update, Delete kategori
- **Manajemen Produk**: Create, Read, Update, Delete produk lengkap
- **Upload Gambar**: Dukungan upload gambar untuk kategori dan produk
- **Pagination**: Navigasi mudah untuk data yang banyak
- **Authentication**: Sistem login admin yang aman

### 4. **Desain & UI/UX**
- Tema warna profesional: **Putih (#FFFFFF), Cream (#F5F1E8), Coklat (#8B6F47)**
- Responsive design (mobile, tablet, desktop)
- Bootstrap 5 framework
- Font Awesome icons
- Smooth transitions dan hover effects

## 📊 URL Frontend

| Halaman | URL |
|---------|-----|
| Beranda | http://localhost:8000/ |
| Kategori | http://localhost:8000/categories |
| Detail Kategori | http://localhost:8000/category/{slug} |
| Detail Produk | http://localhost:8000/product/{slug} |

## 🔐 URL Admin

| Halaman | URL |
|---------|-----|
| Login | http://localhost:8000/admin/login |
| Dashboard | http://localhost:8000/admin/dashboard |
| Manajemen Kategori | http://localhost:8000/admin/categories |
| Manajemen Produk | http://localhost:8000/admin/products |

## 👤 Kredensial Admin Default

**Email:** `admin@meubelsumberrejeki.com`  
**Password:** `admin123456`

## 🚀 Setup & Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- MySQL/MariaDB (sudah tersedia di Laragon)
- Node.js (optional)

### Langkah 1: Setup Database
```bash
cd c:\laragon\www\meubelsumberrejeki

# Database akan otomatis dibuat dari migration
php artisan migrate --seed
```

### Langkah 2: Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

### Langkah 3: Akses Aplikasi
- **Website**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin/login

## 🎨 Desain & Palet Warna

| Elemen | Kode HEX | Deskripsi |
|--------|----------|----------|
| Primary | `#8B6F47` | Coklat - Header, button, badge |
| Secondary | `#F5F1E8` | Cream - Background section |
| Accent | `#FFFFFF` | Putih - Background card |
| Dark | `#5C4A3D` | Coklat Gelap - Text utama |
| Light | `#F9F7F4` | Light Gray - Background page |

## 📦 Struktur Database

### Tabel Categories
```
- id (PK)
- name (unique)
- slug (unique) 
- description (text, nullable)
- image (string, nullable)
- timestamps
```

### Tabel Products
```
- id (PK)
- category_id (FK)
- name
- slug (unique)
- description (text)
- price (decimal)
- stock (int)
- image (string, nullable)
- material (string, nullable)
- color (string, nullable)
- dimension (string, nullable)
- is_featured (boolean)
- timestamps
```

### Tabel Admins
```
- id (PK)
- name
- email (unique)
- email_verified_at (timestamp, nullable)
- password (hashed)
- remember_token (nullable)
- timestamps
```

## 📋 Sample Data

Database sudah berisi data sampel:

### Kategori
1. **Kursi** - Koleksi lengkap kursi berbagai gaya
2. **Meja** - Meja untuk berbagai kebutuhan
3. **Lemari** - Lemari penyimpanan
4. **Sofa** - Sofa dan furniture ruang tamu

### Produk
1. Kursi Makan Kayu Jati Premium - Rp 450.000
2. Meja Makan Minimalis Modern - Rp 2.500.000
3. Sofa L-Shape Luxury Cream - Rp 6.500.000
4. Lemari Pakaian 3 Pintu - Rp 3.200.000
5. Kursi Gaming Ergonomis - Rp 1.500.000

## 🛠️ Fitur Admin Panel

### Dashboard
- Statistik total produk, kategori, produk unggulan
- Stok produk yang terbatas
- Daftar produk terbaru

### Manajemen Kategori
- ✅ Tambah kategori baru
- ✅ Edit kategori
- ✅ Hapus kategori (dengan validasi)
- ✅ Upload gambar kategori
- ✅ Pagination

### Manajemen Produk
- ✅ Tambah produk dengan spesifikasi lengkap
- ✅ Edit produk dan gambar
- ✅ Hapus produk
- ✅ Set produk sebagai unggulan
- ✅ Upload gambar produk
- ✅ Pagination

## 🔒 Keamanan

✅ Middleware authentication untuk admin routes  
✅ Password hashing dengan bcrypt  
✅ CSRF protection di semua form  
✅ Input validation  
✅ Soft delete protection untuk kategori dengan produk  

## 🌐 Teknologi Stack

| Teknologi | Version |
|-----------|---------|
| Laravel | 13.x |
| PHP | 8.2+ |
| Database | MySQL 8.0+ |
| Frontend | Bootstrap 5.3 |
| Icons | Font Awesome 6.4 |
| Package Manager | Composer |

## 📞 Kontak Toko

**Nama Toko**: Meubel Sumber Rejeki  
**Email**: info@meubelsumberrejeki.com  
**Telepon**: +62 821 2345 6789  
**Alamat**: Jl. Sumber Rejeki No. 123, Indonesia

## 📝 Catatan Penting

1. **Upload Gambar**: Format JPG, PNG, GIF (Max 2MB)
2. **Slug Otomatis**: Slug akan otomatis generate dari nama
3. **Stok Produk**: Minimal 0, tampil berbeda jika habis
4. **Kategori Unggulan**: Produk yang di-featured akan muncul di home
5. **Validasi Hapus**: Kategori dengan produk tidak bisa dihapus

## 🔧 Troubleshooting

### Masalah: Database tidak ditemukan
```bash
php artisan migrate --seed
```

### Masalah: Clear cache
```bash
php artisan cache:clear
php artisan config:clear
```

### Masalah: Regenerate autoload
```bash
composer dump-autoload
```

## 📈 Pengembangan Selanjutnya

- [ ] Integrasi payment gateway
- [ ] Shopping cart & checkout
- [ ] Order management
- [ ] Customer reviews & ratings
- [ ] Email notifications
- [ ] SMS notifications
- [ ] Analytics & reporting
- [ ] SEO optimization

## 📄 License

Proprietary © 2026 Meubel Sumber Rejeki. All rights reserved.

---

✨ **Dikembangkan dengan ❤️ oleh GitHub Copilot sebagai Dosen Digital Bisnis**

Selamat menjual! 🎉🛋️

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
