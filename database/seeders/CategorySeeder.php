<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorys=[
            ['name' => 'Electronics'],
            ['name' => 'Clothing'],
            ['name' => 'Books'],
            ['name' => 'Toys'],
            ['name' => 'Home & Garden'],
            ['name' => 'Sports & Outdoors'],
            ['name' => 'Beauty & Personal Care'],
            ['name' => 'Kitchen & Dining'],
            ['name' => 'Office Supplies'],
            ['name' => 'Gifts & Donations'],
            ['name' => 'Services'],
            ['name' => 'Miscellaneous']
        ];
        foreach ($categorys as $category) {
         Category::create($category);
        }
    }
}
