<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'address_line_1', 'address_line_2', 'city', 'state', 'country', 'pin_code'];

    public function saleInvoices()
    {
        return $this->hasMany(SaleInvoice::class);
    }
}
