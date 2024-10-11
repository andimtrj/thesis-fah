<?php

namespace App\Models;

use Exception;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\ProductIngredientH;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function GetPagingProduct(Request $request)
    {
        $authTenantId = Auth::user()->tenant_id;
        $authBranchId = Auth::user()->branch_id;

        if ($authTenantId) {
            $query = Ingredient::from('products as p')
                                ->join('tenants as t', 'p.tenant_id', '=', 't.id')
                                ->join('branches as b', 'p.branch_id', '=', 'b.id')
                                ->join('product_ingredient_h as pih', 'pih.product_id', '=', 'p.id')
                                ->where('p.tenant_id', '=', $authTenantId);
            if($authBranchId)
            {
                $query->where('p.branch_id', '=', $authBranchId);
            }
            else if($request->has('branch_code'))
            {
                $query->where('b.branch_code', '=', $request->input('branch_code'));
            }
            else
            {
                throw new Exception("INVALID BRANCH");
            }

            // Apply filters if branchCode or branchName is provided
            if ($request->input('productCode')) {
                $paramProductCode = $request->input('productCode', null);
                $query->where('p.product_code', 'like', '%' . $paramProductCode . '%');
            }

            if ($request->input('productName')) {
                $paramProductName = $request->input('productName', null);
                $query->where('i.product_name', 'like', '%' . $paramProductName . '%');
            }

            $ingredients = $query->select('p.product_code', 'p.product_name', 'pih.total_ingredients', 'p.product_price')->paginate(10); // Paginate the results
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return $ingredients;

    }
}
