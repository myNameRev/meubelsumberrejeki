# API Routes Reference

## 📌 Frontend Routes (Public)

### Homepage & Navigation

```
GET /
└─ HomeController@index
   └─ Displays: Landing page, featured products, latest products, categories

GET /categories
└─ CategoryController@index
   └─ Displays: All categories with product count

GET /category/{slug}
└─ CategoryController@show
   └─ Displays: Products in category with pagination

GET /product/{slug}
└─ ProductController@show
   └─ Displays: Product details, related products
```

## 🔐 Admin Routes (Protected with auth:admin)

### Authentication

```
GET /admin/login
└─ AuthController@showLogin
   └─ Login form untuk admin

POST /admin/login
└─ AuthController@login
   └─ Process login admin

POST /admin/logout
└─ AuthController@logout
   └─ Logout admin
```

### Dashboard

```
GET /admin/dashboard
└─ DashboardController@index
   └─ Dashboard overview dengan statistik
   └─ Menampilkan:
      - Total produk
      - Total kategori
      - Produk unggulan
      - Stok terbatas
      - Produk terbaru (5)
```

### Category Management (CRUD)

```
GET /admin/categories
└─ Admin\CategoryController@index
   └─ List semua kategori dengan pagination

GET /admin/categories/create
└─ Admin\CategoryController@create
   └─ Form tambah kategori baru

POST /admin/categories
└─ Admin\CategoryController@store
   └─ Simpan kategori baru
   └─ Validasi: name (required, unique), description, image (nullable)
   └─ Features: Auto slug generate, image upload

GET /admin/categories/{category}/edit
└─ Admin\CategoryController@edit
   └─ Form edit kategori

PUT /admin/categories/{category}
└─ Admin\CategoryController@update
   └─ Update kategori
   └─ Features: Update image (delete old if exists)

DELETE /admin/categories/{category}
└─ Admin\CategoryController@destroy
   └─ Hapus kategori
   └─ Validasi: Tidak boleh hapus jika ada produk
```

### Product Management (CRUD)

```
GET /admin/products
└─ Admin\ProductController@index
   └─ List semua produk dengan pagination
   └─ Menampilkan: category, harga, stok, status

GET /admin/products/create
└─ Admin\ProductController@create
   └─ Form tambah produk baru
   └─ Data: categories list

POST /admin/products
└─ Admin\ProductController@store
   └─ Simpan produk baru
   └─ Validasi:
      - category_id (required, exists)
      - name (required)
      - description (required)
      - price (required, numeric, min 0)
      - stock (required, integer, min 0)
      - material, color, dimension (nullable)
      - image (nullable)
      - is_featured (nullable, boolean)
   └─ Features: Auto slug, image upload, featured flag

GET /admin/products/{product}/edit
└─ Admin\ProductController@edit
   └─ Form edit produk
   └─ Data: categories list, current product data

PUT /admin/products/{product}
└─ Admin\ProductController@update
   └─ Update produk
   └─ Features: Update image (delete old if exists)

DELETE /admin/products/{product}
└─ Admin\ProductController@destroy
   └─ Hapus produk (termasuk gambar)
```

## 📋 Request/Response Examples

### Homepage GET /
**Response**: View dengan data
```php
$categories => Collection of Category
$featuredProducts => Collection of Product (6 items, is_featured=true)
$latestProducts => Collection of Product (8 items, latest first)
```

### Login POST /admin/login
**Request**:
```
email: admin@meubelsumberrejeki.com
password: admin123456
remember: 1 (optional)
```

**Response**: Redirect ke dashboard atau kembali ke login dengan error

### Create Product POST /admin/products
**Request** (multipart/form-data):
```
category_id: 1 (required)
name: "Produk Baru" (required)
description: "Deskripsi panjang..." (required)
price: 500000 (required, numeric)
stock: 10 (required, integer)
material: "Kayu Jati" (optional)
color: "Coklat" (optional)
dimension: "100x50x80 cm" (optional)
image: file.jpg (optional, max 2MB)
is_featured: 1 (optional)
```

**Response**: Redirect ke products list dengan success message

## 🛡️ Middleware & Guards

```
auth:admin
├─ Middleware untuk melindungi admin routes
├─ Guard: 'admin'
└─ Provider: 'admins' (Admin model)
```

## 🔄 Slug Generation

Slug otomatis di-generate dari name menggunakan `Str::slug()`:

```
Contoh:
Name: "Kursi Makan Kayu Jati"
Slug: "kursi-makan-kayu-jati"

Name: "Meja Makan Minimalis Modern"
Slug: "meja-makan-minimalis-modern"
```

## 📤 Image Upload

### Direktori
- Categories: `storage/app/public/categories/`
- Products: `storage/app/public/products/`

### URL Access
- Categories: `http://localhost:8000/storage/categories/gambar.jpg`
- Products: `http://localhost:8000/storage/products/gambar.jpg`

### Validasi
- Format: JPG, PNG, GIF
- Max Size: 2MB

## 🔑 Authentication Details

### Admin Login Session
```php
// Setelah login, dapat akses via:
Auth::guard('admin')->user()
// Atau di view: auth('admin')->user()
```

### Logout
```
POST /admin/logout
├─ Invalidate session
├─ Regenerate token
└─ Redirect ke login dengan success message
```

## ⚙️ Error Handling

### Validation Errors
Jika validasi gagal:
- Redirect ke form sebelumnya
- Flash old input ke session
- Tampilkan error messages

### Authorization
- Admin harus login untuk akses admin routes
- Guest users jika logout akan redirect ke login

### 404 Errors
- Category atau Product tidak ditemukan → 404 Not Found

## 📊 Pagination

**Default**: 10 items per page

Routes dengan pagination:
- `GET /categories` (index kategori)
- `GET /category/{slug}` (produk per kategori)
- `GET /admin/categories` (kategori list admin)
- `GET /admin/products` (produk list admin)

## 🎯 URL Patterns

### Frontend
```
/                          → Homepage
/categories                → Kategori list
/category/kursi            → Produk kategori
/product/kursi-makan-kayu  → Detail produk
```

### Admin
```
/admin/login                  → Login form
/admin/dashboard              → Dashboard
/admin/categories             → Kategori list
/admin/categories/create      → Tambah kategori
/admin/categories/1/edit      → Edit kategori
/admin/products               → Produk list
/admin/products/create        → Tambah produk
/admin/products/1/edit        → Edit produk
```

---

**Generated**: 2026-06-09  
**Version**: 1.0  
**Status**: Production Ready ✅
