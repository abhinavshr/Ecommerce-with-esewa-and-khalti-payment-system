<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_name',
        'country',
        'state',
        'city',
        'street_address',
        'postcode',
        'order_notes',
        'total',
        'payment_status',
        'cart_product_name',
        'cart_product_quantity',
    ];
}

