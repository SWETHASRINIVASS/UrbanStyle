<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_number',
        'invoice_date',
        'round_off',
        'global_discount',
        'total_amount',
        
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function SaleInvoiceItems()
    {
        return $this->hasMany(SaleInvoiceItem::class);
    }

    public function SalePayments()
    {
        return $this->hasMany(SalePayment::class, );
    }

    public function SaleReturns()
    {
        return $this->hasOne(SaleReturn::class, );
    }
}
