<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'purchase_price', 'sale_price', 'category', 'stock_quantity', 'image'];

    // Relação com Sales (muitos para muitos)
    public function sales()
    {
        return $this->belongsToMany(Sales::class, 'product_sales')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }

    // Relacionamento muitos-para-muitos
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
