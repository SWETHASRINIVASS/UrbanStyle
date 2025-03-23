<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("customers")->insert([
            [
            'name' => 'Thilaga',
            'email' => 'thilaga@gmail.com',
            'phone' => '1234567890',
            'address_line_1' => '123 street',
            'address_line_2' => '123 street',
            'city' => 'coimbatore',
            'state'=> 'tamilnadu',
            'country' => 'india',
            'pin_code' => '641001',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'sneha',
            'email' => 'sneha@gmail.com',
            'phone' => '9856321470',
            'address_line_1' => '123 street',
            'address_line_2' => '123 street',
            'city' => 'coimbatore',
            'state'=> 'tamilnadu',
            'country' => 'india',
            'pin_code' => '641002',
            'created_at' => now(),
            'updated_at' => now()
            ]

        ]);
    }
}
