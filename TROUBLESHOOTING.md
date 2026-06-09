# 🔧 Troubleshooting Guide

## 🆘 Masalah Umum & Solusi

### 1️⃣ Server tidak bisa dijalankan

**Error**: `The port 8000 is already in use`

**Solusi**:
```bash
# Gunakan port lain
php artisan serve --port=8001

# Atau stop process yang menggunakan port 8000
# Di Windows: taskkill /PID <PID> /F
# Di Mac/Linux: lsof -ti:8000 | xargs kill -9
```

---

### 2️⃣ Database connection error

**Error**: `SQLSTATE[HY000] [2002] No such file or directory` atau `Connection refused`

**Penyebab**: MySQL tidak running

**Solusi**:
1. Buka **Laragon**
2. Klik **Start All** (untuk start Apache & MySQL)
3. Pastikan MySQL status hijau
4. Coba jalankan command lagi

**Atau cek konfigurasi `.env`**:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1      # atau localhost
DB_PORT=3306           # default MySQL port
DB_DATABASE=meubelsumberrejeki
DB_USERNAME=root
DB_PASSWORD=           # kosong untuk Laragon
```

---

### 3️⃣ Database 'meubelsumberrejeki' tidak ada

**Error**: `WARN The database 'meubelsumberrejeki' does not exist`

**Solusi**:
```bash
# Jalankan migration (akan auto create database)
php artisan migrate --seed

# Atau jika ada error, gunakan fresh
php artisan migrate:fresh --seed
```

---

### 4️⃣ Class not found / Fatal error

**Error**: `Class 'App\Models\Category' not found` atau similar

**Penyebab**: Autoload tidak generate dengan benar

**Solusi**:
```bash
# Regenerate autoload
composer dump-autoload

# Atau
composer install
```

---

### 5️⃣ CSRF token mismatch

**Error**: `CSRF token mismatch` saat form submit

**Penyebab**: Session issue atau cache problem

**Solusi**:
```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear

# Jika masih error, clear session
php artisan session:clear

# Atau refresh seluruh cache
php artisan config:cache
php artisan route:cache
```

---

### 6️⃣ Upload gambar tidak berfungsi

**Error**: Gambar tidak tersimpan atau error saat upload

**Penyebab**: Storage link belum dibuat atau permission issue

**Solusi**:
```bash
# Buat symbolic link
php artisan storage:link

# Set permission folder storage
# Di Windows (PowerShell as Admin):
icacls "storage" /grant:r "%username%":(OI)(CI)F /T

# Di Mac/Linux:
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

**Check if link exists**:
```bash
# Cek apakah sudah ada folder storage link
dir public/storage
ls -la public/storage   # Mac/Linux
```

---

### 7️⃣ Gambar tidak ditampilkan di view

**Error**: Image tag menampilkan placeholder / 404

**Solusi**:
1. Pastikan storage link sudah dibuat (lihat #6)
2. Cek file benar-benar tersimpan di folder:
   ```
   storage/app/public/categories/
   storage/app/public/products/
   ```
3. Gunakan URL yang benar:
   ```blade
   {{ asset('storage/categories/gambar.jpg') }}
   {{ asset('storage/products/gambar.jpg') }}
   ```

---

### 8️⃣ Admin tidak bisa login

**Error**: Login gagal atau infinite redirect

**Penyebab**: 
- Credentials salah
- Seeding tidak jalan
- Session issue

**Solusi**:

1. **Reset admin user**:
```bash
# Jalankan seeding ulang
php artisan db:seed

# Atau jika ingin reset semua
php artisan migrate:fresh --seed
```

2. **Default credentials**:
```
Email: admin@meubelsumberrejeki.com
Password: admin123456
```

3. **Verify admin exists di database**:
```bash
# Login ke MySQL
mysql -u root -p meubelsumberrejeki

# Query:
SELECT * FROM admins;
```

---

### 9️⃣ Halaman admin kosong / tidak load

**Error**: Halaman blank atau loading forever

**Penyebab**: 
- Middleware authentication blocking
- View file missing
- Controller error

**Solusi**:

1. **Check server logs**:
```bash
# Terminal akan tampilkan error saat request
# Lihat terminal tempat php artisan serve running
```

2. **Enable debug mode** di `.env`:
```env
APP_DEBUG=true
```

3. **Verify route exists**:
```bash
php artisan route:list | grep admin
```

---

### 🔟 Pagination tidak bekerja

**Error**: Link pagination error atau 404

**Penyebab**: Database query issue atau middleware blocking

**Solusi**:
```blade
{{-- Pastikan menggunakan links() dengan benar --}}
{{ $products->links() }}

{{-- Untuk custom view --}}
{{ $products->links('pagination::bootstrap-4') }}
```

---

### 1️⃣1️⃣ Delete kategori error

**Error**: `SQLSTATE[23000]: Integrity constraint violation`

**Penyebab**: Kategori memiliki produk, tidak bisa dihapus

**Solusi**: 
- Delete semua produk dalam kategori terlebih dahulu
- Atau delete produk dari admin panel

**Validasi pada aplikasi**: Sudah ada check, akan tampil error message

---

### 1️⃣2️⃣ Validation error di form

**Error**: Form input tidak passing validation

**Solusi**:
1. Cek error message yang ditampilkan
2. Ikuti rule validation:
   - Nama kategori/produk: required, string
   - Harga: numeric, min 0
   - Stok: integer, min 0
   - Email: valid email format
   - Gambar: JPG/PNG/GIF, max 2MB

---

### 1️⃣3️⃣ Route not found / 404

**Error**: `Route not found` atau 404 error

**Solusi**:
```bash
# Verify routes registered
php artisan route:list

# Cek prefix dan middleware
grep -r "admin" routes/

# Jika routes error, refresh:
php artisan route:cache
php artisan route:clear
```

---

### 1️⃣4️⃣ Permission denied / Access denied

**Error**: 403 Forbidden atau "You do not have access"

**Penyebab**: 
- User tidak login
- Tidak punya role/permission
- Middleware blocking

**Solusi**:
1. Pastikan sudah login sebagai admin
2. Clear cache & session
3. Check auth middleware di routes

---

### 1️⃣5️⃣ "The debug log file has grown too large"

**Error**: Storage/logs/laravel.log terlalu besar

**Solusi**:
```bash
# Clear log file
rm storage/logs/laravel.log

# Atau di Windows
del storage\logs\laravel.log

# Atau set log size limit di config/logging.php
```

---

## 🔍 Debug Tips

### 1. Gunakan dd() function
```php
// Di controller
dd($products);      // Dump and die

// Di view
@dd($variable)
```

### 2. Gunakan Log
```php
// Di controller
Log::info('Debug message', ['variable' => $value]);

// Check log
tail -f storage/logs/laravel.log
```

### 3. Inspect Database
```bash
mysql -u root meubelsumberrejeki

# Check tables
SHOW TABLES;

# Check data
SELECT * FROM categories;
SELECT * FROM products;
SELECT * FROM admins;
```

### 4. Browser DevTools
- F12 untuk buka DevTools
- Check Network tab untuk failed requests
- Check Console untuk JavaScript errors

### 5. Laravel Tinker
```bash
php artisan tinker

# Di tinker shell
>>> App\Models\Product::all()
>>> App\Models\Category::find(1)
>>> Auth::guard('admin')->user()
```

---

## 📋 Checklist Before Going Live

- [ ] APP_DEBUG = false
- [ ] APP_ENV = production
- [ ] APP_KEY generated
- [ ] Database backed up
- [ ] Storage link created
- [ ] File permissions correct
- [ ] Admin password changed
- [ ] All routes tested
- [ ] All forms validated
- [ ] Images optimized
- [ ] Error handling implemented
- [ ] Logs monitored

---

## 📞 Bantuan Lebih Lanjut

1. **Check documentation**: `README.md`, `INSTALLATION.md`, `FEATURES_GUIDE.md`
2. **Check Laravel docs**: https://laravel.com/docs
3. **Check GitHub issues**: https://github.com/laravel/framework/issues
4. **Ask in Laravel community**: https://laracasts.com/discuss

---

**Good luck debugging! 💪**
