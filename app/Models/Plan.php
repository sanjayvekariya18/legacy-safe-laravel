<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'monthly_price',
        'yearly_price',
        'description',
        'currency',
        'product_id',
        'monthly_price_id',
        'yearly_price_id',
        'is_active',
    ];

    protected $dates = ['deleted_at'];

    // Relationships
    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }
}
