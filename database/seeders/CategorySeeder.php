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
                'name' => 'Shirts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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
        ]);
    }
}
