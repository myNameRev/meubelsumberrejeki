<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::create([
            'name' => 'Admin Meubel',
            'email' => 'admin@meubelsumberrejeki.com',
            'password' => bcrypt('admin123456'),
        ]);

        // Create sample categories
        $kategoriKursi = Category::create([
            'name' => 'Kursi',
            'slug' => 'kursi',
            'description' => 'Koleksi lengkap kursi untuk berbagai kebutuhan ruangan Anda dengan desain modern dan nyaman.',
        ]);

        $kategoriMeja = Category::create([
            'name' => 'Meja',
            'slug' => 'meja',
            'description' => 'Meja berkualitas tinggi yang cocok untuk ruang tamu, ruang makan, atau kantor.',
        ]);

        $kategoriLemari = Category::create([
            'name' => 'Lemari',
            'slug' => 'lemari',
            'description' => 'Lemari penyimpanan dengan desain elegan untuk melengkapi interior rumah Anda.',
        ]);

        $kategoriSofa = Category::create([
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'Sofa empuk dan nyaman yang menjadi pusat kenyamanan keluarga Anda.',
        ]);

        // Create sample products
        Product::create([
            'category_id' => $kategoriKursi->id,
            'name' => 'Kursi Makan Kayu Jati Premium',
            'slug' => 'kursi-makan-kayu-jati-premium',
            'description' => 'Kursi makan dengan kerangka kayu jati pilihan, seat empuk dengan bahan fabric berkualitas tinggi. Cocok untuk ruang makan modern maupun klasik.',
            'price' => 450000,
            'stock' => 15,
            'material' => 'Kayu Jati',
            'color' => 'Coklat Natural',
            'dimension' => '45 x 45 x 85 cm',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $kategoriMeja->id,
            'name' => 'Meja Makan Minimalis Modern',
            'slug' => 'meja-makan-minimalis-modern',
            'description' => 'Meja makan dengan desain minimalis dan modern, terbuat dari material berkualitas. Dapat mengakomodasi 4-6 orang dengan nyaman.',
            'price' => 2500000,
            'stock' => 8,
            'material' => 'Kayu Kombinasi Besi',
            'color' => 'Coklat & Hitam',
            'dimension' => '150 x 80 x 75 cm',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $kategoriSofa->id,
            'name' => 'Sofa L-Shape Luxury Cream',
            'slug' => 'sofa-l-shape-luxury-cream',
            'description' => 'Sofa L-Shape dengan ukuran besar dan seat yang sangat empuk. Bahan fabric premium dengan warna cream yang elegan untuk ruang tamu modern.',
            'price' => 6500000,
            'stock' => 5,
            'material' => 'Fabric Premium, Foam, Kayu',
            'color' => 'Cream',
            'dimension' => '240 x 160 x 85 cm',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $kategoriLemari->id,
            'name' => 'Lemari Pakaian 3 Pintu',
            'slug' => 'lemari-pakaian-3-pintu',
            'description' => 'Lemari pakaian dengan 3 pintu, interior luas dengan gantungan dan rak penyimpanan. Desain elegan dengan finishing natural.',
            'price' => 3200000,
            'stock' => 6,
            'material' => 'Kayu Solid',
            'color' => 'Coklat Natural',
            'dimension' => '150 x 50 x 200 cm',
            'is_featured' => false,
        ]);

        Product::create([
            'category_id' => $kategoriKursi->id,
            'name' => 'Kursi Gaming Ergonomis',
            'slug' => 'kursi-gaming-ergonomis',
            'description' => 'Kursi gaming dengan desain ergonomis yang nyaman untuk sesi gaming panjang. Dilengkapi dengan sandaran kepala dan lumbar support.',
            'price' => 1500000,
            'stock' => 12,
            'material' => 'Mesh & Busa Memori',
            'color' => 'Hitam & Coklat',
            'dimension' => '65 x 65 x 125 cm',
            'is_featured' => true,
        ]);
    }
}

