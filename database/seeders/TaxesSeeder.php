<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Tax;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taxes')->insert([
            [
                'tax_name' => 'GST 5%',
                'tax_rate' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tax_name' => 'GST 12%',
                'tax_rate' => 12.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tax_name' => 'GST 18%',
                'tax_rate' => 18.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tax_name' => 'GST 28%',
                'tax_rate' => 28.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tax_name' => 'VAT 10%',
                'tax_rate' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}