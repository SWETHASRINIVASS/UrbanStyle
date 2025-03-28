<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'supplier_id',
        'invoice_date',
        'round_off',
        'global_discount',
        'total_amount',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseInvoiceItems()
    {
        return $this->hasMany(PurchaseInvoiceItem::class, 'purchase_invoice_id');
    }

    public function getTotalAmountAttribute()
{
    if (!$this->relationLoaded('purchaseInvoiceItems') || $this->purchaseInvoiceItems === null) {
        return $this->attributes['total_amount'] ?? 0;
    }

    $total =  $this->purchaseInvoiceItems->isNotEmpty() ? $this->purchaseInvoiceItems->sum(function ($item) {
        return ($item->quantity * $item->price) 
             - (($item->quantity * $item->price) * ($item->discount / 100)) 
             + (($item->quantity * $item->price) * ($item->tax_rate / 100));
    }) : $this->attributes['total_amount'] ?? 0;

    $total -= $this->global_discount ?? 0;

    return $total;
}

    public function purchasePayments()
    {
        return $this->hasMany(PurchasePayment::class);
    }

    public function purchaseReturns()
    {
        return $this->hasOne(PurchaseReturn::class, );
    }

}
