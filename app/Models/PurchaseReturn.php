<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_invoice_id', 'product_id', 'quantity',
        'return_reason', 'return_amount', 'return_date'
    ];

    public function purchaseInvoice()
    {
        return $this->belongsTo(PurchaseInvoice::class,'purchase_invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchaseReturnItems()
    {
        return $this->hasMany(PurchaseReturnItem::class);
    }
}
