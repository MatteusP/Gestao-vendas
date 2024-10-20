<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'coupon_sales';

    protected $fillable = [
        'sale_id',
        'coupon_id',
    ];
}
