<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Metric;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Ingredient;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductIngredientD;
use App\Models\ProductIngredientH;
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
        $validator = $this->validateProductRequest($request);

        if ($validator->fails()) {
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            $response->message = 'Invalid Input : ' . $validator->errors()->first();

            return redirect()->intended('/product')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
        }
        try{
            DB::transaction(function () use ($request, &$response) {
                $this->createProductTransaction($request);
                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;

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
            abort(500, "Invalid Tenant");
        }

        return view('product', compact('tenant', 'branches', 'formSubmitted')); // Pass tenant variable to view
    }

    public function showAddProductPage(){

        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            $queryIngredient = Ingredient::with('branch')
                                            ->with('metric')
                                            ->where('tenant_id', '=', $authTenantId);
            $metrics = Metric::get();

            if(Auth::user()->branch_id){
                $queryIngredient->where('branch_id', '=', Auth::user()->branch_id);
            }
            $ingredients = $queryIngredient->get();
            $productCategories = ProductCategory::where('tenant_id', '=', $authTenantId)->get();
            return view('components.product.add-product', compact('productCategories', 'tenant', 'branches', 'ingredients', 'metrics'));
        } else {
            abort(500, "Invalid Tenant");
        }
    }


    private function createProductTransaction($request)
    {
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

        if (!$product) {
            throw new \Exception("Failed to create product");
        }

        $request->merge(['product' => $product]);
        $this->productIngredientController->CreateProductIngredient($request);
    }

    private function validateProductRequest($request)
    {
        return Validator::make($request->all(), [
            'productName' => 'required|string|max:255',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'branchCode' => 'required|string|max:8|exists:branches,branch_code',
            'productCategoryCode' => 'required|string|exists:product_categories,prod_category_code',
            'productPrice' => 'required|numeric',
            'isActive' => 'required|boolean',
            'ingredients' => 'required|array',
            'ingredients.*.ingredient_code' => 'required|string|exists:ingredients,ingredient_code',
            'ingredients.*.amount' => 'required|numeric|min:0',
            'ingredients.*.metric_code' => 'required|string|exists:metrics,metric_code'
        ]);
    }

    public function showEditProductPage($id){


        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $product = Product::findOrFail($id);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            $queryIngredient = Ingredient::with('branch')
                                        ->with('metric')
                                        ->where('tenant_id', '=', $authTenantId);
            $queryProductCategories = ProductCategory::where('tenant_id', '=', $authTenantId);

            if(Auth::user()->branch_id){
                $queryIngredient->where('branch_id', '=', Auth::user()->branch_id);
                $queryProductCategories->where('branch_id', '=', $product->branch_id);
            }
            $ingredients = $queryIngredient->get();
            $productCategories = $queryProductCategories->get();

            $productIngredient = ProductIngredientH::with([
                'productIngredientD' => function ($query) {
                    $query->with([
                        'ingredients' => function ($query) {
                            $query->with('metric');
                        }
                    ])
                    ->join('metrics as m', 'product_ingredient_d.metric_id', '=', 'm.id')
                    ->select([
                        'product_ingredient_d.*',
                        DB::raw('FORMAT(product_ingredient_d.ingredient_amt / POWER(10, m.metric_seq_no - 1), 2) as converted_ingredient_amt')
                    ]);
                }
            ])
            ->where('product_id', '=', $product->id)
            ->firstOrFail();
            $metrics = Metric::get();
        } else {
            abort(500, "Invalid Tenant");
        }


        // Pass the branch to the view
        return view('components.product.edit-product', compact('tenant', 'product', 'branches', 'productCategories', 'productIngredient', 'ingredients', 'metrics'));
    }

    public function UpdateProduct(Request $request, $id){

        $validatedData =  $this->validateProductRequest($request);

        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // dd($validatedData);

        try{
            DB::transaction(function () use ($request, $id, &$response) {
                $product = Product::findOrFail($id);
                $product->product_name = $request->input('productName');
                $product->is_active = $request->input('isActive');
                $branch = Branch::where('branch_code', '=', $request->input('branchCode'))->firstOrFail();
                $product->Branch()->associate($branch);
                $product->ProductCategory()->associate(ProductCategory::where('prod_category_code', '=', $request->input('productCategoryCode'))->firstOrFail());
                $product->product_price = $request->input('productPrice');

                $requestProductIngredient = $request->input('ingredients', []);
                $productIngredient = ProductIngredientH::with('productIngredientD')
                                                        ->where('product_id', '=', $product->id)->firstOrFail();


                // Extract the prod_ing_d_no values from the request
                $requestProductIngredientDNo = array_column($requestProductIngredient, 'prod_ing_d_no');

                // Get all existing prod_ing_d_no values in the database
                $existingProductIngredientD = $productIngredient->productIngredientD->pluck('prod_ing_d_no')->all();

                // Find the prod_ing_d_no values to delete
                $prodIngDNoToDelete = array_diff($existingProductIngredientD, $requestProductIngredientDNo);

                // Delete the ProductIngredientD entries that are not in the request
                ProductIngredientD::whereIn('prod_ing_d_no', $prodIngDNoToDelete)->delete();

                foreach($requestProductIngredient as $item){
                    $productIngredientDNo = $item['prod_ing_d_no'] ?? null;
                    $metric = Metric::where('metric_code', '=', $item['metric_code'])->firstOrFail();
                    $ingredient = Ingredient::where('ingredient_code', '=', $item['ingredient_code'])->firstOrFail();
                    if ($metric) {  // Ensure metric exists
                        $factor = $metric->metric_seq_no - 1;
                    } else {
                        // Handle the case where metric is not found, if necessary
                        $response = new BaseResponseObj();
                        $response->statusCode = '500';
                        $response->message = 'An Error Occurred During Registration : Metric not exists!';

                        return redirect()->intended('/product')->with([
                            'status' => $response->statusCode,
                            'message' => $response->message,
                        ]);
                    }

                    if($productIngredientDNo){
                        $productIngredientD = $productIngredient->productIngredientD()->where('prod_ing_d_no', '=', $productIngredientDNo)->firstOrNew([]);
                        $productIngredientD->ingredient_id = $ingredient->id;
                        $ingredientAmount = $item['amount'] * pow(10, $factor);

                        $productIngredientD->ingredient_amt = $ingredientAmount;
                        $productIngredientD->metric_id = $metric->id;

                        $productIngredientD->save();
                    }
                    else
                    {

                        $ingredientAmount = $item['amount'] * pow(10, $factor);
                        $prodIngredientDNo = $this->productIngredientController->GenerateProductIngredientDNo();

                        ProductIngredientD::create([
                            'prod_ing_h_id' => $productIngredient->id,
                            'ingredient_id' => $ingredient->id,  // Correctly accessing the id property
                            'ingredient_amt' => $ingredientAmount,
                            'metric_id' => $metric->id,  // Assuming you want to save the metric id
                            'prod_ing_d_no' => $prodIngredientDNo
                        ]);

                    }

                }
                $productIngredient->total_ingredients = count($requestProductIngredient);
                $productIngredient->save();
                $product->save();

                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
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
        return redirect()->intended('/product')->with([
            'status' => $response->statusCode,
            'message' => $response->message,
        ]);
    }

    public function DeleteProduct($id){
        try{
            $product = Product::findOrFail($id);
            $product->delete();
        } catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Delete : ' . $e->getMessage();

            return redirect()->intended('/product')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }
    }


}
