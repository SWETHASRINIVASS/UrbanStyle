<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = ['tax_name', 'tax_rate'];

    public function purchaseInvoices()
    {
        return $this->hasMany(PurchaseInvoice::class);
    }

    public function purchaseInvoiceItems()
    {
        return $this->hasMany(PurchaseInvoiceItem::class);
    }

    public function purchaseReturns()
    {
        return $this->hasMany(PurchaseReturn::class);
    }

    public function saleInvoices()
    {
        return $this->hasMany(SaleInvoice::class);
    }

    public function saleInvoiceItems()
    {
        return $this->hasMany(SaleInvoiceItem::class);
    }

    public function saleReturns()
    {
        return $this->hasMany(SaleReturn::class);
    }
}
