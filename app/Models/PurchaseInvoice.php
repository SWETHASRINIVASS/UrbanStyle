<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id', 'invoice_no', 'amount', 'discount', 'tax_price', 
        'round_off', 'total_amount', 'status', 'date', 'payment_mode'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseInvoiceItems()
    {
        return $this->hasMany(PurchaseInvoiceItem::class);
    }

    public function purchasePayments()
    {
        return $this->hasMany(PurchasePayment::class);
    }
}
