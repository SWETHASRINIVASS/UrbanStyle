<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'address_line_1', 'address_line_2', 
        'city', 'state', 'country', 'pin_code'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchaseInvoices()
    {
        return $this->hasMany(PurchaseInvoice::class);
    }
}
