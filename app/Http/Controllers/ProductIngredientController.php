<?php

namespace App\Http\Controllers;

use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use App\Models\ProductIngredientH;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductIngredientD;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Validator;

class ProductIngredientController extends Controller
{
    public function CreateProductIngredient(Request $request){
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.amt' => 'required|numeric|min:0'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            DB::transaction(function() use($request, &$response){
                $productIngredientCode = $this->GenerateProductIngredientHNo();
                $product = $request->input('product');
                $ingredients = $request->input('ingredients');

                $productIngredientH = ProductIngredientH::create([
                    'prod_h_ing_code' => $productIngredientCode,
                    'product_id' => $product->id,
                    'total_ingredients' => count($ingredients)
                ]);

                foreach($ingredients as $ingredient){
                    ProductIngredientD::create([
                        'prod_h_ing_id' => $productIngredientH->id,
                        'ingredient_id' => $ingredient->id,
                        'ingredient_amt' => $ingredient->amt
                    ]);
                }


                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';
                $response->data = $productIngredientH;

                return $response;
            });

            return redirect()->intended('/branch')->with('status', $response->statusCode);

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration. ' . $e->getMessage();

            return redirect()->intended('/branch')->with('status', $response->message);

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
}
