<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIngredientD extends Model
{
    use HasFactory;

    protected $table = 'product_ingredient_d';

    protected $fillable = [
        'prod_ing_h_id',
        'ingredient_id',
        'ingredient_amt',
        'metric_id',
        'prod_ing_d_no'
    ];

    public function ProductIngredientH(){
        return $this->belongsTo(ProductIngredientH::class, 'prod_ing_h_id');
    }

    public function Ingredients(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
