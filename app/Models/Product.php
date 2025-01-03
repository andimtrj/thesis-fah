<?php

namespace App\Models;

use Exception;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\ProductIngredientH;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

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

    public function ProductIngredientH(){
        return $this->hasOne(ProductIngredientH::class);
    }

    public function Branch(){
        return $this->belongsTo(Branch::class);
    }

    public function Tenant(){
        return $this->belongsTo(Tenant::class);
    }

    public function ProductCategory(){
        return $this->belongsTo(ProductCategory::class);
    }


    public static function GetPagingProduct(Request $request)
    {
        $authTenantId = Auth::user()->tenant_id;
        $authBranchId = Auth::user()->branch_id;

        if ($authTenantId) {
            $query = Product::join('tenants as t', 'products.tenant_id', '=', 't.id')
                                ->join('branches as b', 'products.branch_id', '=', 'b.id')
                                ->leftJoin('product_ingredient_h as pih', 'pih.product_id', '=', 'products.id')
                                ->where('products.tenant_id', '=', $authTenantId);
            if($request->has('branchCode'))
            {
                $query->where('b.branch_code', '=', $request->input('branchCode'));
            }
            else
            {
                throw new Exception("INVALID BRANCH");
            }

            // Apply filters if branchCode or branchName is provided
            if ($request->input('productCode')) {
                $paramProductCode = $request->input('productCode', null);
                $query->where('products.product_code', 'like', '%' . $paramProductCode . '%');
            }

            if ($request->input('productName')) {
                $paramProductName = $request->input('productName', null);
                $query->where('products.product_name', 'like', '%' . $paramProductName . '%');
            }

            $ingredients = $query->select('products.product_code', 'products.product_name', DB::raw('COALESCE(pih.total_ingredients, 0) as total_ingredients'), 'products.product_price', 'products.id')->paginate(10); // Paginate the results
        } else {
            abort(500, "Invalid Tenant");
        }

        return $ingredients;

    }
}
