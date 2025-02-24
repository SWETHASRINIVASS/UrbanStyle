<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("products")->insert([
            [
                'name' => 'Shirt',
                'category_id' => 1,
                'supplier_id' => 1,
                'purchase_price' => 1500,
                'sale_price' => 2000,
                'current_stock' => 100,
                'hsn_code' => '1452',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Jeans',
                'category_id'=> 2,
                'supplier_id'=> 2,
                'purchase_price'=> 2000,
                'sale_price'=> 2500,
                'current_stock'=> 100,
                'hsn_code'=> '1452',
                'created_at'=> now(),
                'updated_at'=> now()
            ],

            [
                'name'=> 'Kurtis',
                'category_id'=> 3,
                'supplier_id'=> 1,
                'purchase_price'=> 1000,
                'sale_price'=> 1500,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ]

        ]);
    }
}
