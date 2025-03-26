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

    public function saleInvoiceItems()
    {
        return $this->hasMany(SaleInvoiceItem::class,'sale_invoice_id');
    }

    public function getTotalAmountAttribute()
{
    if (!$this->relationLoaded('saleInvoiceItems') || $this->saleInvoiceItems === null) {
        return $this->attributes['total_amount'] ?? 0;
    }

    return $this->saleInvoiceItems->isNotEmpty() ? $this->saleInvoiceItems->sum(function ($item) {
        return ($item->quantity * $item->price) 
             - (($item->quantity * $item->price) * ($item->discount / 100)) 
             + (($item->quantity * $item->price) * ($item->tax_rate / 100));
    }) : $this->attributes['total_amount'] ?? 0;
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
