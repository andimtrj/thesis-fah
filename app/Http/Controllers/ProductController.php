<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Ingredient;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productIngredientController;
    public function __construct(ProductIngredientController $productIngredientController)
    {
        $this->productIngredientController = $productIngredientController;
    }

    public function InsertProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'productName' => 'required|string|max:255',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'branchCode' => 'required|string|max:8|exists:branches,branch_code',
            'productCategoryCode' => 'required|string|max:8|exists:product_categories,product_category_code',
            'productPrice' => 'required|numeric',
            'isActive' => 'required|boolean',
            'ingredients' => 'required|array',
            'ingredients.*.ingredient_code' => 'required|integer|exists:ingredients,ingredient_code',
            'ingredients.*.amount' => 'required|numeric|min:0',
            'ingredients.*.metric_code' => 'required|string|exists:metrics, metric_code'
        ]);

        dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            DB::transaction(function () use ($request, &$response) {
                $productCode = $this->GenerateProductCode();
                $tenantId = Tenant::GetTenantIdByTenantCode($request->input('tenantCode'));
                $branchId = Branch::GetBranchIdByBranchCode($request->input('branchCode'));
                $productCategoryId = ProductCategory::GetProductCategoryIdByProductCategoryCode($request->input('productCategoryCode'));

                $product = Product::create([
                    'product_code' => $productCode,
                    'product_name' => $request->input('productName'),
                    'product_category_id' => $productCategoryId,
                    'tenant_id' => $tenantId,
                    'branch_id' => $branchId,
                    'product_price' => $request->input('productPrice'),
                    'is_active' => $request->input('isActive'),
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);

                if ($product) {
                    $request->merge(['product' => $product]);

                    $response = $this->productIngredientController->CreateProductIngredient($request);

                    return $response;
                }
            });

            return redirect()->intended('/product')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/product')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }
    }

    private static function GenerateProductCode()
    {
        $lastProductCode = DB::table('products')
            ->orderBy('product_code', 'desc')
            ->first()
            ->product_code ?? null;


        if ($lastProductCode == null) {
            $newProductCode = 'P0000001';
        } else {
            $lastProductCodeNum = (int) substr($lastProductCode, 1);

            $newNumber = ++$lastProductCodeNum;

            $newProductCode = 'P' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }

        return $newProductCode;
    }

    public function showProductPage(Request $request)
    {
        $formSubmitted = $request->has('branchCode') || $request->has('productCode') || $request->has('productName');
        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            if($formSubmitted){
                $products = Product::GetPagingProduct($request)->withQueryString();
                return view('product', compact('tenant', 'branches', 'products', 'formSubmitted')); // Pass tenant variable to view

            }
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('product', compact('tenant', 'branches', 'formSubmitted')); // Pass tenant variable to view
    }

    public function showAddProductPage(){

        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            $ingredients = Ingredient::where('tenant_id', '=', $authTenantId)->get();
            $productCategories = ProductCategory::where('tenant_id', '=', $authTenantId)->get();
            return view('components.product.add-product', compact('productCategories', 'tenant', 'branches', 'ingredients'));
        } else {
            throw new \Exception("Tenant Code Is Null");
        }


    }

}
