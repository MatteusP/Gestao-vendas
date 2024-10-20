<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_sales';

    protected $fillable = [
        'product_id',
        'sale_id',
        'quantity',
        'unit_price',
    ];
}
