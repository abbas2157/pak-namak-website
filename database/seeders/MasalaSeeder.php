<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasalaSeeder extends Seeder
{
    public function run(): void
    {
        $masala = Category::updateOrCreate(['slug' => 'masala-jaat'], [
            'name' => 'Masala Jaat', 'name_ur' => 'مصالحہ جات – خالص اور معیاری', 'sort_order' => 4,
        ]);

        // Same product list as the spice types in the operations app.
        $products = [
            ['Chilli Powder', 'لال مرچ پاؤڈر'],
            ['Turmeric Powder', 'ہلدی پاؤڈر'],
            ['Chilli Darra Powder', 'مرچ دڑا'],
            ['Garam Masala (Peesa Howa)', 'گرم مصالحہ (پسا ہوا)'],
            ['Garam Masala (Sabit)', 'گرم مصالحہ (ثابت)'],
            ['Dania (Peesa Howa)', 'دھنیا (پسا ہوا)'],
            ['Dania (Sabit)', 'دھنیا (ثابت)'],
        ];

        foreach ($products as $i => [$name, $nameUr]) {
            Product::firstOrCreate(['slug' => Str::slug($name)], [
                'category_id' => $masala->id, 'name' => $name, 'name_ur' => $nameUr, 'sort_order' => 20 + $i,
            ]);
        }
    }
}
