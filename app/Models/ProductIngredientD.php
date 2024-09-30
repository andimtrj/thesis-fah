<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIngredientD extends Model
{
    use HasFactory;

    protected $table = 'product_ingredient_d';

    protected $fillable = [
        'prod_h_ing_id',
        'ingredient_id',
        'ingredient_amt'
    ];

    public function ProductIngredientH(){
        return $this->belongsTo(ProductIngredientH::class);
    }
}
