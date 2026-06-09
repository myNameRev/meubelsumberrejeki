# 👨‍💻 Development Guide

## 🛠️ Development Environment Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/MariaDB
- VS Code atau editor favorit
- Git (optional)

### Tools Recommendations
- **Laravel Debugbar**: `barryvdh/laravel-debugbar`
- **IDE Helper**: `barryvdh/laravel-ide-helper`
- **Laravel Pint**: Code formatter (sudah include)
- **Postman**: API testing

---

## 📁 Project Structure

```
app/
├── Models/
│   ├── Admin.php          // Admin user model
│   ├── Category.php       // Kategori meubel
│   └── Product.php        // Produk meubel
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── CategoryController.php
│   │   ├── ProductController.php
│   │   └── Admin/
│   │       ├── AuthController.php
│   │       ├── DashboardController.php
│   │       ├── CategoryController.php
│   │       └── ProductController.php
│   └── Middleware/
│       └── (custom middleware jika perlu)
├── Rules/
│   └── (custom validation rules)
└── Exceptions/
    └── (custom exceptions)

config/
├── app.php               // App configuration
├── auth.php             // Authentication config (sudah setup admin guard)
├── database.php         // Database connections
└── filesystems.php      // File storage config

database/
├── migrations/          // Database schemas
│   ├── 2026_06_09_000001_create_categories_table.php
│   ├── 2026_06_09_000002_create_products_table.php
│   └── 2026_06_09_000003_create_admins_table.php
└── seeders/            // Data seeding
    └── DatabaseSeeder.php

resources/views/
├── layouts/            // Main layouts
│   ├── app.blade.php   // Frontend layout
│   └── admin.blade.php // Admin layout
├── home/               // Home page views
├── categories/         // Category views
├── products/           // Product views
└── admin/              // Admin views
    ├── auth/
    ├── categories/
    └── products/

routes/
└── web.php            // Web routes (semua routes di sini)

storage/
└── app/
    └── public/        // File upload destination
        ├── categories/
        └── products/

public/
├── storage/           // Symbolic link ke storage/app/public
├── index.php          // Entry point
└── (css, js, images)

.env                   // Environment variables
.env.example           // Environment example
composer.json          // Dependencies
composer.lock          // Lock file
```

---

## 🔄 Workflow Development

### 1. Menambah Feature Baru

**Contoh: Tambah field "warranty" pada produk**

1. **Create Migration**:
```bash
php artisan make:migration add_warranty_to_products_table
```

2. **Edit migration** (`database/migrations/...`):
```php
Schema::table('products', function (Blueprint $table) {
    $table->string('warranty')->nullable()->after('dimension');
});
```

3. **Run migration**:
```bash
php artisan migrate
```

4. **Update Model** (`app/Models/Product.php`):
```php
protected $fillable = [
    'warranty',  // Add this
    // ...
];
```

5. **Update Controller**:
```php
// In validation
'warranty' => 'nullable|string',

// In store/update
$data['warranty'] = $request->warranty;
```

6. **Update View** (form input):
```blade
<input type="text" name="warranty" class="form-control" value="{{ old('warranty', $product->warranty ?? '') }}">
```

### 2. Membuat Custom Validation Rule

```php
// php artisan make:rule UniqueProductName

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueProductName implements Rule
{
    public function passes($attribute, $value)
    {
        return Product::where('name', $value)->count() === 0;
    }

    public function message()
    {
        return 'Nama produk sudah ada.';
    }
}
```

### 3. Custom Exception Handling

```php
// app/Exceptions/ProductNotFoundException.php

namespace App\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    public function render()
    {
        return response()->view('errors.404', [], 404);
    }
}
```

---

## 🎨 Styling Guidelines

### Color Variables (CSS)
```css
:root {
    --primary: #8B6F47;      /* Coklat */
    --secondary: #F5F1E8;    /* Cream */
    --accent: #FFFFFF;       /* Putih */
    --dark: #5C4A3D;         /* Coklat Gelap */
    --light: #F9F7F4;        /* Light Gray */
}
```

### Naming Conventions
- Prefix Bootstrap classes dengan `btn-` untuk buttons
- Prefix custom classes dengan component name (`.hero`, `.stat-card`)
- Use kebab-case untuk class names

### Responsive Breakpoints
```scss
// Mobile First Approach
$sm: 576px;   // Small devices
$md: 768px;   // Medium devices
$lg: 992px;   // Large devices
$xl: 1200px;  // Extra large devices
$xxl: 1400px; // XXL devices
```

---

## 📝 Blade Template Tips

### Useful Blade Directives
```blade
{{-- Comments (tidak di-render) --}}

{{-- Escaping output (prevent XSS) --}}
{{ $variable }}

{{-- Raw output --}}
{!! $html !!}

{{-- Conditionals --}}
@if($condition)
@elseif($other)
@else
@endif

{{-- Loops --}}
@foreach($items as $item)
    {{ $loop->index }}      // 0-indexed
    {{ $loop->iteration }}  // 1-indexed
@endforeach

{{-- Include views --}}
@include('partials.header')
@include('partials.header', ['title' => 'Hello'])

{{-- Checked/Selected in forms --}}
<input type="checkbox" @checked($condition)>
<option @selected($value == $item)>Option</option>

{{-- Auth check --}}
@auth('admin')
    // Admin specific content
@endauth

@guest('admin')
    // Not logged in content
@endguest

{{-- Old input (from validation) --}}
{{ old('field', $default) }}
```

---

## 🔐 Security Best Practices

### Input Validation
```php
// Always validate input
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:admins',
    'password' => 'required|min:8|confirmed',
    'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
]);
```

### XSS Prevention
```blade
{{-- Use {{ }} untuk escape HTML --}}
{{ $user->name }}  // Safe

{{-- Gunakan {!! !!} hanya untuk trusted content --}}
{!! $html !!}
```

### CSRF Protection
```blade
{{-- Selalu include CSRF token di form --}}
<form method="POST" action="/save">
    @csrf
    {{-- form fields --}}
</form>
```

### SQL Injection Prevention
```php
// ❌ JANGAN: Raw queries
$users = DB::select("SELECT * FROM users WHERE id = " . $id);

// ✅ GUNAKAN: Parameterized queries
$users = User::where('id', $id)->get();
```

---

## 📊 Database Queries Best Practices

### Eager Loading (Prevent N+1)
```php
// ❌ N+1 Problem
$products = Product::all();
foreach ($products as $product) {
    echo $product->category->name;  // Query pada setiap loop
}

// ✅ Eager Loading
$products = Product::with('category')->get();
foreach ($products as $product) {
    echo $product->category->name;  // Sudah di-load
}
```

### Pagination
```php
// Basic
$products = Product::paginate(15);

// With sorting
$products = Product::orderBy('created_at', 'desc')->paginate(15);

// With relations
$products = Product::with('category')->paginate(15);
```

---

## 🧪 Testing (Future Implementation)

### Unit Test Example
```php
// tests/Unit/ProductTest.php
namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_product_has_name()
    {
        $product = Product::first();
        $this->assertIsString($product->name);
    }
}
```

### Feature Test Example
```php
// tests/Feature/AdminProductTest.php
namespace Tests\Feature;

use App\Models\Admin;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    public function test_admin_can_create_product()
    {
        $admin = Admin::first();
        
        $response = $this->actingAs($admin, 'admin')
            ->post('/admin/products', [
                'category_id' => 1,
                'name' => 'Test Product',
                'description' => 'Test',
                'price' => 100000,
                'stock' => 10,
            ]);
        
        $response->assertRedirect('/admin/products');
    }
}
```

---

## 🚀 Code Quality Tools

### Laravel Pint (Code Formatting)
```bash
# Format code
./vendor/bin/pint

# Dry run
./vendor/bin/pint --test
```

### PHP Stan (Static Analysis)
```bash
# Install
composer require phpstan/phpstan --dev

# Run
./vendor/bin/phpstan analyse app
```

---

## 📚 Useful Artisan Commands

```bash
# Cache management
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Cache optimization (production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate              # Run migrations
php artisan migrate:rollback    # Rollback migrations
php artisan migrate:refresh     # Refresh (rollback + migrate)
php artisan migrate:fresh       # Fresh (drop + migrate)
php artisan migrate:fresh --seed # Fresh + seed

# Seeding
php artisan db:seed             # Run seeders
php artisan db:seed --class=AdminSeeder

# Model generation
php artisan make:model Post     # Model only
php artisan make:model Post -m  # Model + migration
php artisan make:model Post -mc # Model + migration + controller

# Controller generation
php artisan make:controller HomeController
php artisan make:controller Admin/CategoryController -r  # Resourceful

# Utility
php artisan tinker              # Interactive shell
php artisan serve               # Start dev server
php artisan list                # List all commands
php artisan help migrate        # Help for specific command
```

---

## 🔗 Git Workflow (If Using Git)

```bash
# Clone repository
git clone <repo-url>

# Create feature branch
git checkout -b feature/add-warranty

# Make changes and commit
git add .
git commit -m "feat: add warranty field to products"

# Push to remote
git push origin feature/add-warranty

# Create pull request
# Merge after review
```

---

## 🎯 Performance Tips

1. **Use Pagination**: Jangan load semua data sekaligus
2. **Eager Load Relations**: Gunakan `with()` untuk prevent N+1 queries
3. **Cache Database Queries**: Gunakan Laravel cache untuk expensive queries
4. **Optimize Images**: Compress images sebelum upload
5. **Use Indexes**: Add database indexes pada kolom yang sering di-query
6. **Lazy Load Collections**: Gunakan `lazy()` untuk processing large datasets

---

## 📖 Learning Resources

- **Laravel Documentation**: https://laravel.com/docs
- **Laracasts**: https://laracasts.com
- **Laravel News**: https://laravel-news.com
- **Spatie Packages**: https://spatie.be/open-source

---

**Happy Coding!** 🚀
