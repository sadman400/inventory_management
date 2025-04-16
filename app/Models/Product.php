<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'description',
        'cost_price',
        'selling_price',
        'stock_quantity',
        'reorder_level',
    ];
}
