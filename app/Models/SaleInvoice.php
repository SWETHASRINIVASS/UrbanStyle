<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'invoice_number', 'date', 'amount', 'discount', 
        'tax_price', 'round_off', 'total_amount', 'status', 'phone'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleInvoiceItems()
    {
        return $this->hasMany(SaleInvoiceItem::class);
    }

    public function salePayments()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function SaleReturns()
    {
        return $this->hasOne(SaleReturn::class);
    }
}
