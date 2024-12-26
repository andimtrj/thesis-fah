<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    public function Branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function Products() : HasMany
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    public static function GetProductCategoryIdByProductCategoryCode(string $productCategoryCode){

        $producCategory = ProductCategory::where('prod_category_code', $productCategoryCode)->firstOrFail();
        return $producCategory->id;
    }

}
