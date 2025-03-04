<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'invoice_number', 'invoice_date', 'tax_rate', 'subtotal', 'tax_amount', 'total_amount', 'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function SaleInvoiceItems()
    {
        return $this->hasMany(SaleInvoiceItem::class,'sale_invoice_id');
    }

    public function SalePayments()
    {
        return $this->hasMany(SalePayment::class, 'sale_invoice_id');
    }

    public function SaleReturns()
    {
        return $this->hasOne(SaleReturn::class, 'sale_invoice_id');
    }
}
