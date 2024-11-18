<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'monthly_price',
        'yearly_price',
        'stripe_product_id',
        'stripe_price_id_monthly',
        'stripe_price_id_yearly',
    ];
}
