<?php

namespace App\Http\Controllers;

use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use App\Models\ProductIngredientH;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Metric;
use App\Models\ProductIngredientD;
use App\View\Components\ingredient as ComponentsIngredient;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Validator;

class ProductIngredientController extends Controller
{
    public function CreateProductIngredient(Request $request){
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'ingredients' => 'required|array',
            'ingredients.*.ingredient_code' => 'required|string|exists:ingredients,ingredient_code',
            'ingredients.*.amount' => 'required|numeric|min:0',
            'ingredients.*.metric_code' => 'required|string|exists:metrics,metric_code'
        ]);

        if($validator->fails()){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration: ' . implode(', ', $validator->errors()->all());

            return redirect()->intended('/branch')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
        }

        try{

            DB::transaction(function() use($request, &$response){
                $productIngredientCode = $this->GenerateProductIngredientHNo();
                $product = $request->input('product');
                $ingredients = $request->input('ingredients');

                $productIngredientH = ProductIngredientH::create([
                    'prod_ing_h_no' => $productIngredientCode,
                    'product_id' => $product['id'],
                    'total_ingredients' => count($ingredients)
                ]);

                foreach ($ingredients as $ingredient) {
                    $metric = Metric::where('metric_code', $ingredient['metric_code'])->first();
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

                    $ingredientId = Ingredient::where('ingredient_code', $ingredient['ingredient_code'])
                                              ->select('id')->first();

                    if (!$ingredientId) {
                        // Handle the case where ingredient is not found, if necessary
                        $response = new BaseResponseObj();
                        $response->statusCode = '500';
                        $response->message = 'An Error Occurred During Registration : Ingredient Not Exists!';

                        return redirect()->intended('/product')->with([
                            'status' => $response->statusCode,
                            'message' => $response->message,
                        ]);
                    }

                    // Correct power calculation
                    $ingredientAmount = $ingredient['amount'] * pow(10, $factor);
                    $prodIngredientDNo = $this->GenerateProductIngredientDNo();

                    ProductIngredientD::create([
                        'prod_ing_h_id' => $productIngredientH->id,
                        'ingredient_id' => $ingredientId->id,  // Correctly accessing the id property
                        'ingredient_amt' => $ingredientAmount,
                        'metric_id' => $metric->id,  // Assuming you want to save the metric id
                        'prod_ing_d_no' => $prodIngredientDNo
                    ]);
                }


                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';
                $response->data = $productIngredientH;

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


    private static function GenerateProductIngredientHNo(){
        $lastProductIngredientCode = DB::table('product_ingredient_h')
        ->orderBy('prod_ing_h_no', 'desc')
        ->first()
        ->prod_ing_h_no ?? null;


        if($lastProductIngredientCode == null){
            $newProductIngredientCode = 'PIH0000001';
        }
        else{
            $lastProductIngredientCodeNum = (int) substr($lastProductIngredientCode, 3);

            $newNumber = ++$lastProductIngredientCodeNum;

            $newProductIngredientCode = 'PIH' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }

        return $newProductIngredientCode;

    }

    public static function GenerateProductIngredientDNo(){
        $lastProductIngredientCode = DB::table('product_ingredient_d')
        ->orderBy('prod_ing_d_no', 'desc')
        ->first()
        ->prod_ing_d_no ?? null;


        if($lastProductIngredientCode == null){
            $newProductIngredientCode = 'PID000000001';
        }
        else{
            $lastProductIngredientCodeNum = (int) substr($lastProductIngredientCode, 3);

            $newNumber = ++$lastProductIngredientCodeNum;

            $newProductIngredientCode = 'PID' . str_pad($newNumber, 9, '0', STR_PAD_LEFT);
        }

        return $newProductIngredientCode;

    }

}
