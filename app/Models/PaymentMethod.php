<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'is_active'];

    /**
     * Get the bookings for the payment method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentmethods(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
