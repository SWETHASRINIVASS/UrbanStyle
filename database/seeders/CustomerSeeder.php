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
            'name' => 'swetha',
            'email' => 'swetha@gmail.com',
            'phone' => '1234567890',
            'address_line_1' => '123 street',
            'address_line_2' => '123 street',
            'city' => 'coimbatore',
            'state'=> 'tamilnadu',
            'country' => 'india',
            'pincode' => '641001',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
                'name'=> 'ravi',
                'email' => 'ravi@gmail.com',
                'phone' => '9876543210',
                'address_line_1' => '123 street',
                'address_line_2' => '123 street',
                'city' => 'coimbatore',
                'state'=> 'tamilnadu',
                'country'=> 'india',
                'pincode'=> '638402',
                'created_at'=> now(),
                'updated_at'=> now()
            ]

        ]);
    }
}
