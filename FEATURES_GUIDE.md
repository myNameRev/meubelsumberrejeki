# 🎨 Panduan Lengkap Fitur Meubel Sumber Rejeki

## 1️⃣ Fitur Frontend (Publik)

### 🏠 Halaman Beranda (Home)

**URL**: `http://localhost:8000/`

**Konten**:
- ✨ Hero section dengan tagline dan call-to-action
- 🌟 Bagian "Produk Unggulan" (6 produk terbaru yang di-featured)
- 🔥 Bagian "Produk Terbaru" (8 produk terbaru)
- 📂 Kategori Produk grid
- 📋 Section tentang toko
- 📞 Section kontak dengan map

**Fitur**:
- Link klick ke detail kategori dan produk
- Button "Belanja Sekarang" dan "Lihat Katalog"
- Button admin panel di navbar

### 📂 Halaman Kategori (Category List)

**URL**: `http://localhost:8000/categories`

**Konten**:
- Daftar semua kategori dalam grid
- Gambar kategori
- Deskripsi kategori
- Jumlah produk di setiap kategori
- Button "Lihat Kategori"

**Fitur**:
- Responsive grid layout
- Hover effect pada card
- Link ke kategori detail

### 🎯 Halaman Detail Kategori

**URL**: `http://localhost:8000/category/kursi` (contoh slug)

**Konten**:
- Header kategori dengan gambar dan deskripsi
- Grid produk dengan pagination (12 produk/halaman)
- Badge untuk produk unggulan
- Harga dan stok setiap produk
- Kategori lain yang bisa dilihat

**Fitur**:
- Pagination untuk navigasi produk
- Breadcrumb navigation
- Related categories
- Filter by category

### 📦 Halaman Detail Produk

**URL**: `http://localhost:8000/product/kursi-makan-kayu-jati-premium` (contoh slug)

**Konten**:
- Gambar produk besar
- Nama dan kategori produk
- Harga dengan format Rupiah
- Deskripsi lengkap
- Spesifikasi: Material, Warna, Dimensi
- Status stok
- Button pesan dan hubungi
- Produk terkait (4 produk sejenis)

**Fitur**:
- Breadcrumb navigation
- Status stok visual (Tersedia/Habis)
- Badge produk unggulan
- Related products section
- Pricing display dengan format lokal

---

## 2️⃣ Fitur Admin (Protected)

### 🔐 Login Admin

**URL**: `http://localhost:8000/admin/login`

**Fitur**:
- Form login dengan email & password
- Remember me checkbox
- Validasi form
- Error message jika login gagal
- Link kembali ke website

**Akun Default**:
```
Email: admin@meubelsumberrejeki.com
Password: admin123456
```

### 📊 Dashboard Admin

**URL**: `http://localhost:8000/admin/dashboard`

**Statistik Cards**:
- 📦 Total Produk
- 📂 Total Kategori
- ⭐ Produk Unggulan
- ⚠️ Stok Terbatas (< 5)

**Konten**:
- Tabel produk terbaru (5 item)
- Tombol link ke manajemen kategori & produk
- Quick action buttons

**Fitur**:
- Real-time stats
- Color-coded status
- Quick navigation

### 📂 Manajemen Kategori

#### List Kategori
**URL**: `http://localhost:8000/admin/categories`

**Tabel**:
- # (nomor urut dengan pagination)
- Nama kategori (dengan gambar thumbnail)
- Slug
- Deskripsi (dipotong 50 char)
- Jumlah produk dalam kategori
- Action (Edit, Hapus)

**Fitur**:
- Pagination (10 per halaman)
- Thumbnail gambar kategori
- Delete confirmation
- Quick edit link

#### Tambah Kategori
**URL**: `http://localhost:8000/admin/categories/create`

**Form**:
- Nama kategori (required, unique)
- Deskripsi (textarea, optional)
- Upload gambar (JPG/PNG/GIF, max 2MB, optional)

**Validasi**:
- Nama harus unique
- Deskripsi text saja
- Gambar max 2MB

**Proses**:
- Slug auto-generate dari nama
- Gambar disimpan ke `storage/categories/`
- Redirect ke list dengan success message

#### Edit Kategori
**URL**: `http://localhost:8000/admin/categories/{id}/edit`

**Fitur**:
- Pre-fill data kategori saat ini
- Tampilkan gambar saat ini
- Update gambar (optional)
- Update slug jika nama berubah
- Delete gambar lama saat upload baru

#### Hapus Kategori
- Konfirmasi delete
- Validasi: Tidak bisa hapus jika ada produk dalam kategori
- Error message jika ada produk
- Delete file gambar jika ada

### 📦 Manajemen Produk

#### List Produk
**URL**: `http://localhost:8000/admin/products`

**Tabel**:
- # (nomor urut)
- Nama produk (dengan thumbnail gambar)
- Kategori (badge)
- Harga (format Rupiah)
- Stok (color-coded: hijau >10, kuning 1-10, merah habis)
- Status (Unggulan atau Normal)
- Action (Edit, Hapus)

**Fitur**:
- Pagination (10 per halaman)
- Color-coded stock status
- Category badge
- Thumbnail gambar
- Quick edit

#### Tambah Produk
**URL**: `http://localhost:8000/admin/products/create`

**Form (Kolom 1)**:
- Kategori (required, dropdown)
- Nama produk (required)
- Deskripsi (required, textarea)
- Harga (required, numeric, min 0)
- Stok (required, integer, min 0)
- Material (optional)
- Warna (optional)
- Dimensi (optional)
- Upload gambar (JPG/PNG/GIF, max 2MB, optional)
- Checkbox "Jadikan Produk Unggulan" (optional)

**Validasi Lengkap**:
- Category exists
- Nama required
- Deskripsi required
- Harga numeric
- Stok integer
- Gambar format & size valid

**Proses**:
- Auto-generate slug dari nama
- Simpan gambar ke `storage/products/`
- Set is_featured jika checkbox aktif
- Redirect ke list dengan success message

#### Edit Produk
**URL**: `http://localhost:8000/admin/products/{id}/edit`

**Fitur**:
- Pre-fill semua data saat ini
- Tampilkan gambar saat ini
- Update gambar (optional)
- Update semua field
- Delete gambar lama saat upload baru
- Update is_featured status

#### Hapus Produk
- Konfirmasi delete
- Delete file gambar jika ada
- Redirect dengan success message

---

## 3️⃣ Fitur Teknis

### 🎨 Responsive Design
- Mobile (< 576px)
- Tablet (576px - 992px)
- Desktop (> 992px)
- Semua layout menyesuaikan dengan screen size

### 🖼️ Image Upload & Storage
- Upload ke folder `storage/app/public/`
- Akses via URL `storage/{folder}/{filename}`
- Auto-delete gambar lama saat update
- Format support: JPG, PNG, GIF
- Max size: 2MB

### 🔐 Security
- Middleware `auth:admin` untuk routes admin
- CSRF token di semua form
- Password hashing dengan bcrypt
- Input validation di semua form
- SQL injection protection via Eloquent

### 🎨 UI/UX
- **Color Scheme**:
  - Coklat (#8B6F47) - Primary
  - Cream (#F5F1E8) - Secondary
  - Putih (#FFFFFF) - Accent
  - Coklat gelap (#5C4A3D) - Text

- **Components**:
  - Cards dengan shadow & hover effect
  - Buttons dengan various styles
  - Badges untuk status
  - Alert messages (success, error, info)
  - Tables dengan hover effect
  - Pagination
  - Breadcrumb

### 📊 Data Relationships
```
Category (1) ---> (Many) Product
                    |
                    └---> Admin (Create/Update)

Admin (1) ---> (Many) Category (Management)
Admin (1) ---> (Many) Product (Management)
```

### 🔄 Data Validation & Sanitization
- All inputs validated before save
- XSS protection via Blade escaping
- CSRF protection
- File upload validation
- Slug generation & validation

---

## 4️⃣ Penggunaan Sehari-hari

### Untuk Pelanggan
1. Kunjungi `http://localhost:8000`
2. Jelajahi kategori di navbar atau halaman kategori
3. Klik produk untuk melihat detail lengkap
4. Lihat spesifikasi, harga, dan ketersediaan stok

### Untuk Admin

**Setiap Hari**:
1. Login ke `http://localhost:8000/admin/login`
2. Cek dashboard untuk overview
3. Manage produk & kategori sesuai kebutuhan

**Tambah Produk Baru**:
1. Go to Admin → Produk → Tambah Produk
2. Isi form lengkap
3. Upload gambar
4. Set sebagai featured jika perlu
5. Klik Simpan

**Update Stok**:
1. Go to Admin → Produk → Edit
2. Update field "Stok"
3. Klik Update

**Delete Produk**:
1. Go to Admin → Produk
2. Klik Hapus di row produk
3. Konfirmasi delete

---

## 5️⃣ Tips & Trik

✅ **Gambar Produk**: Upload foto produk dari berbagai sudut untuk hasil terbaik  
✅ **Deskripsi**: Tulis deskripsi yang detail dan menarik  
✅ **Kategori**: Buat kategori yang jelas & spesifik  
✅ **Unggulan**: Set produk populer sebagai "unggulan" untuk ditampilkan di home  
✅ **Stok**: Update stok secara berkala  

---

**Selamat menggunakan Meubel Sumber Rejeki!** 🎉
