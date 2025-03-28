<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'supplier_id', 
        'purchase_price', 'sale_price', 'current_stock', 'hsn_code'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function purchaseInvoiceItems()
    {
        return $this->hasMany(PurchaseInvoiceItem::class);
    }

    public function saleInvoiceItems()
    {
        return $this->hasMany(SaleInvoiceItem::class);
    }

    public function updateStock($quantity, $operation = 'add')
    {
        if ($operation === 'add') {
            $this->increment('current_stock', $quantity);
        } else {
            $this->decrement('current_stock', $quantity);
        }
    }
}
