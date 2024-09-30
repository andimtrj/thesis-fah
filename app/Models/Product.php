<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code' ,
        'product_name',
        'product_category_id',
        'tenant_id',
        'branch_id',
        'product_price',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public function ProductIngredient(){
        return $this->hasOne(ProductIngredientH::class);
    }
}
