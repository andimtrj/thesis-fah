<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\ProductIngredientD;
use App\Models\ProductIngredientH;
use App\Models\UsageTrxD;
use App\Models\UsageTrxDAlloc;

class UsageTrxDAllocController extends Controller
{
    public function InsertUsageTrxDAlloc(UsageTrxD $usageTrxD)
    {
        if($usageTrxD == null){
            throw new \Exception('Usage Transaction D is Null!');
        }

        $productIngredientHId = ProductIngredientH::where('product_id', '=', $usageTrxD->product_id)->value('id');
        $listProductIngredientD = ProductIngredientD::where('prod_ing_h_id', '=', $productIngredientHId)->get();

        foreach($listProductIngredientD as $item){
            $ingredient = Ingredient::where('id', $item->ingredient_id)->first();
            if (!$ingredient) {
                throw new \Exception("Ingredient not found for ID {$item->ingredient_id}!");
            }

            $usageTrxDAlloc = new UsageTrxDAlloc();
            $usageTrxDAlloc->ingredient_id = $ingredient->id;
            $usageTrxDAlloc->ingredient_amt = $item->ingredient_amt * $usageTrxD->product_amt;
            $usageTrxDAlloc->ingredient_name = $ingredient->ingredient_name;

            $usageTrxD->UsageTrxDAlloc()->save($usageTrxDAlloc);

            $ingredient->ingredient_amt = $ingredient->ingredient_amt - ($item->ingredient_amt * $usageTrxD->product_amt);

            $ingredient->save();
        }
    }
}
