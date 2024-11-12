<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Metric;
use App\Models\PurchaseTrxD;
use App\Models\PurchaseTrxH;
use Illuminate\Http\Request;

class PurchaseTrxDController extends Controller
{
    public function InsertPurchaseTrxD(Request $request, PurchaseTrxH $purchaseTrxH){
        if($purchaseTrxH == null || $request == null){
            throw new \Exception('Request Or Usage Transaction H is Null!');
        }

        $listRequestIngredients = $request->input('ingredients', []);
        foreach($listRequestIngredients as $item){
            $ingredient = Ingredient::where('ingredient_code', '=', $item['ingredientCode'])->firstOrFail();
            if($ingredient == null){
                throw new \Exception("Ingredient with code {$item['ingredientCode']} not found!");
            }

            $metric = Metric::where('metric_code', '=', $item['metricCode'])->firstOrFail();
            if($metric == null){
                throw new \Exception("Metric with code {$item['metricCode']} not found!");
            }

            $factor = $metric->metric_seq_no - 1;
            $ingredientAmt = $item['ingredientAmt'] * pow(10, $factor);

            $purchaseTrxD = new PurchaseTrxD();
            $purchaseTrxD->ingredient_id = $ingredient->id;
            $purchaseTrxD->ingredient_amt = $ingredientAmt;
            $purchaseTrxD->ingredient_name = $ingredient->ingredient_name;
            $purchaseTrxD->notes = $item['notes'] ?? "";
            $purchaseTrxD->metric_id = $metric->id;

            $purchaseTrxH->PurchaseTrxD()->save($purchaseTrxD);

            $ingredient->ingredient_amt = $ingredient->ingredient_amt + $ingredientAmt;
            $ingredient->save();
        }

    }
}
