<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ValidatorController extends Controller
{
    public function IngredientTransactionValidator(Request $request, string $trxTypeCode){
        return Validator::make($request->all(), [
            'branchCode' => 'required|string|max:8|exists:branches,branch_code',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'trxDate' => 'required|date',
            'ingredients' => 'required|array',
            'ingredients.*.ingredientCode' => 'required|string|exists:ingredients,ingredient_code',
            'ingredients.*.ingredientAmt' => 'required|numeric' . $trxTypeCode == 'PUR' ? '|min:0' : '',
            'ingredients.*.metricCode' => 'required|string|exists:metrics,metric_code',
            'ingredients.*.notes' => 'string|nullable'
        ]);
    }
}
