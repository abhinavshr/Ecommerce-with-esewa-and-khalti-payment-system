<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_short_description',
        'product_image',
        'product_price',
        'product_category',
        'product_quantity',
        'discounted_price',
        'product_status',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}

}

