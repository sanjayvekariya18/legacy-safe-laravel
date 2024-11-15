<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_TO_BE_PAID = "to_be_paid";
    const STATUS_COMPLETED = "completed";
    protected $fillable = [
        'user_id',
        'invoice_id',
        'name',
        'amount',
        'description',
        'status',
    ];

    protected $dates = ['deleted_at'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Convert status enum to readable format.
     *
     * @return string
     */
    public function getStatusReadableAttribute()
    {
        switch ($this->status) {
            case 'to_be_paid':
                return 'To be paid';
            case 'completed':
                return 'Completed';
            default:
                return 'Unknown Status'; // In case you have other statuses in the future
        }
    }
}
