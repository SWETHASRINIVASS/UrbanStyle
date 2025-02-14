<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;

    protected $fillable = ['sale_invoice_id', 'amount', 'round_off', 'total_amount', 'date', 'payment_method', 'balance_due', 'status'];

    public function saleInvoice()
    {
        return $this->belongsTo(SaleInvoice::class);
    }
}
