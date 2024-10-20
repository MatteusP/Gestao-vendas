<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'discount_percent',
        'expiration_date',
        'user_id',
    ];

    // Relação com User (um para muitos)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com Sales (muitos para muitos)
    public function sales()
    {
        return $this->belongsToMany(Sales::class, 'coupon_sales')
                    ->withTimestamps();
    }
}
