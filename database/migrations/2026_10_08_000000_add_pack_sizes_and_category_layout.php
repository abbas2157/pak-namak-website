<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('pack_sizes')->nullable()->after('price');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('layout', 20)->default('cards')->after('name_ur');
        });

        // Packed Salt is one product in many sizes: show it as a size table, not repeated cards.
        DB::table('categories')->where('slug', 'packed-salt')->update(['layout' => 'table']);

        // Masala is sold in every packet size; the first four have real packet photos.
        $allSizes = json_encode(['50g', '100g', '200g', '250g', '500g', '1kg', '2kg', '5kg', '10kg']);
        $masalaId = DB::table('categories')->where('slug', 'masala-jaat')->value('id');
        if ($masalaId) {
            DB::table('products')->where('category_id', $masalaId)->update(['pack_sizes' => $allSizes]);
        }

        $photos = [
            'chilli-powder' => 'images/masala-chilli-powder.jpg',
            'turmeric-powder' => 'images/masala-turmeric.jpg',
            'chilli-darra-powder' => 'images/masala-chilli-darra.jpg',
            'garam-masala-peesa-howa' => 'images/masala-garam-masala.jpg',
        ];
        foreach ($photos as $slug => $image) {
            DB::table('products')->where('slug', $slug)->whereNull('image')->update(['image' => $image]);
        }

        $urdu = [
            'chilli-powder' => 'لال مرچ پاؤڈر',
            'turmeric-powder' => 'ہلدی پاؤڈر',
            'chilli-darra-powder' => 'مرچ دڑا',
            'garam-masala-peesa-howa' => 'گرم مصالحہ (پسا ہوا)',
            'garam-masala-sabit' => 'گرم مصالحہ (ثابت)',
            'dania-peesa-howa' => 'دھنیا (پسا ہوا)',
            'dania-sabit' => 'دھنیا (ثابت)',
        ];
        foreach ($urdu as $slug => $nameUr) {
            DB::table('products')->where('slug', $slug)->whereNull('name_ur')->update(['name_ur' => $nameUr]);
        }

        // NTN as printed on the masala packets; shown in the footer.
        DB::table('settings')->insertOrIgnore(['key' => 'ntn', 'value' => '3149651-2', 'created_at' => now(), 'updated_at' => now()]);
        Cache::forget('settings');
    }

    public function down(): void
    {
        Schema::table('products', fn (Blueprint $table) => $table->dropColumn('pack_sizes'));
        Schema::table('categories', fn (Blueprint $table) => $table->dropColumn('layout'));
    }
};
