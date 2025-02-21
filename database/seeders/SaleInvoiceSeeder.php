<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\SaleInvoice;

class SaleInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("SaleInvoice")->insert([
            [
                'customer_id' => 1,
                'invoice_number' => 'INV1',
                'invoice_date'=> '21-02-2025',
                'amount' => '2000',
                'discount'=> '200',
                'tax_price'=> '30',
                'round_off'=> '2230',
                'total_amount'=> '2230',
                'status'=> 'completed',
                'phone'=> '123654789',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
