<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\PurchaseInvoice;

class PurchaseInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("PurchaseInvoice")->insert([
            [
                'supplier_id' => 1,
                'invoice_number' => 'INV1',
                'invoice_date'=> '21-02-2025',
                'total_amount' => '2000',
                'paid_amount' => '1000',
                'due_amount' => '1000',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
