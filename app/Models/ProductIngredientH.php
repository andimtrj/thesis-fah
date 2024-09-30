<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIngredientH extends Model
{
    use HasFactory;

    protected $table = 'product_ingredient_h';

    protected $fillable = [
        'prod_h_ing_code',
        'product_id',
        'total_ingredients'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productIngredientD(){
        return $this->hasMany(ProductIngredientD::class);
    }
}
