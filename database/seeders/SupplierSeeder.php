<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("suppliers")->insert([
            [
                'name' => 'xyz',
                'phone' => '4587934160',
                'email' => 'xyz@gmail.com',
                'address_line_1' => '123 street',
                'address_line_2' => '123 street',
                'city' => 'coimbatore',
                'state' => 'tamilnadu',
                'country' => 'india',
                'pin_code' => '641001',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'pqr',
                'phone' => '4587961230',
                'email' => 'pqr@gmail.com',
                'address_line_1' => '123 street',
                'address_line_2' => '123 street',
                'city' => 'coimbatore',
                'state' => 'tamilnadu',
                'country' => 'india',
                'pin_code' => '641002',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
