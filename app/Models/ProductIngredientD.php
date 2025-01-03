<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function ProductIngredientH() : BelongsTo
    {
        return $this->belongsTo(ProductIngredientH::class, 'prod_ing_h_id');
    }

    public function Ingredients() : BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
