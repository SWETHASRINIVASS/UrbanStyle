<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories")->insert([
            
            [
                'name' => 'Jeans',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kurtis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'T-Shirts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shirts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarees',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Leggings',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shorts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Skirts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jackets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sweaters',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blazers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coats',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suits',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
