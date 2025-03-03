<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_invoice_id', 'product_id', 'quantity',
        'return_reason', 'refund_amount', 'refund_date'
    ];

    public function saleInvoice()
    {
        return $this->belongsTo(SaleInvoice::class,'sale_invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function saleReturnItems()
    {
        return $this->hasMany(SaleReturnItem::class);
    }
}
