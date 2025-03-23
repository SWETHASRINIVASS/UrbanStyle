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
                'category_id' => 10,
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
                'category_id'=> 1,
                'supplier_id'=> 2,
                'purchase_price'=> 2000,
                'sale_price'=> 2500,
                'current_stock'=> 100,
                'hsn_code'=> '1452',
                'created_at'=> now(),
                'updated_at'=> now()
            ],

            [
                'name'=> 'T shirt',
                'category_id'=> 11,
                'supplier_id'=> 3,
                'purchase_price'=> 1000,
                'sale_price'=> 1500,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Leggings',
                'category_id'=> 2,
                'supplier_id'=> 1,
                'purchase_price'=> 500,
                'sale_price'=> 1000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Skirts',
                'category_id'=> 4,
                'supplier_id'=> 2,
                'purchase_price'=> 3000,
                'sale_price'=> 4000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Shorts',
                'category_id'=> 3,
                'supplier_id'=> 3,
                'purchase_price'=> 1500,
                'sale_price'=> 2000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Blazers',
                'category_id'=> 7,
                'supplier_id'=> 1,
                'purchase_price'=> 5000,
                'sale_price'=> 6000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Jackets',
                'category_id'=> 5,
                'supplier_id'=> 2,
                'purchase_price'=> 4000,
                'sale_price'=> 5000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Coats',
                'category_id'=> 8,
                'supplier_id'=> 3,
                'purchase_price'=> 6000,
                'sale_price'=> 7000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Suits',
                'category_id'=> 9,
                'supplier_id'=> 2,
                'purchase_price'=> 7000,
                'sale_price'=> 8000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=> 'Saree',
                'category_id'=> 12,
                'supplier_id'=> 1,
                'purchase_price'=> 3000,
                'sale_price'=> 4000,
                'current_stock'=> 100,
                'hsn_code'=> '7896',
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        

        ]);
    }
}
