<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'customer_name',
        'customer_cpf',
        'customer_phone',
        'customer_email',
        'coupon_code',
        'user_id',
        'status',
    ];

    // Relação com User (um para muitos)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com Products (muitos para muitos)
// Defina a relação com o modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relação com Coupons (muitos para muitos)
    public function coupons()
    {
        return $this->belongsToMany(Coupons::class, 'coupon_sales')
                    ->withTimestamps();
    }
}
