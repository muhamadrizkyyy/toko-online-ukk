<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "name" => "Fashion Pria",
            "slug" => "fashion-pria",
        ]);
        Category::create([
            "name" => "Fashion Wanita",
            "slug" => "fashion-wanita",
        ]);
        Category::create([
            "name" => "Ibu dan Anak",
            "slug" => "ibu-dan-anak",
        ]);
    }
}
