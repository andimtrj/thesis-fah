<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\AdjustmentTrxH;
use App\Http\Controllers\Controller;
use App\Models\AdjustmentTrxD;

class AdjustmentTrxDController extends Controller
{
    public function InsertAdjustmentTrxD(Request $request, AdjustmentTrxH $adjustmentTrxH){
        if($adjustmentTrxH == null || $request == null){
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

            $adjustmentTrxD = new AdjustmentTrxD();
            $adjustmentTrxD->ingredient_id = $ingredient->id;
            $adjustmentTrxD->ingredient_amt = $ingredientAmt;
            $adjustmentTrxD->ingredient_name = $ingredient->ingredient_name;
            $adjustmentTrxD->notes = $item['notes'] ?? "";
            $adjustmentTrxD->metric_id = $metric->id;

            $adjustmentTrxH->AdjustmentTrxD()->save($adjustmentTrxD);

            $ingredient->ingredient_amt = $ingredient->ingredient_amt + $ingredientAmt;
            $ingredient->save();

        }

    }
}
