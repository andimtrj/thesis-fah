<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Tenant;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Metric;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    public function InsertIngredient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ingredientName' => 'required|string|max:255',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'branchCode' => 'required|string|max:8|exists:branches,branch_code',
            'metricCode' => [
                'required',
                'string',
                'max:8',
                function ($attribute, $value, $fail) use ($request) { //Jagain metrics biar kalau diubah2 sm user dr front end ga bisa keinput.
                    $validMetrics = [
                        'weight' => ['kg', 'grams', 'tons'],
                        'volume' => ['liters', 'ml', 'gallons'],
                        'pieces' => ['Pcs']
                    ];

                    if (!isset($validMetrics[$request->metricGroup]) || !in_array($value, $validMetrics[$request->metricGroup])) {
                        $fail("The selected $attribute is invalid for the given metric group.");
                    }
                },
            ],
            'ingredientAmt' => 'required|decimal'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            DB::transaction(function () use ($request, &$response) {
                $ingredientCode = $this->GenerateIngredientCode();
                $tenantId = Tenant::GetTenantIdByTenantCode($request->input('tenantCode'));
                $branchId = Branch::GetBranchIdByBranchCode($request->input('branchCode'));
                $metricId = Metric::GetMetricIdByMetricCode($request->input('metricCode'));

                Ingredient::create([
                    'ingredient_code' => $ingredientCode,
                    'ingredient_name' => $request->input('ingredientName'),
                    'metric_id' => $metricId,
                    'tenant_id' => $tenantId,
                    'branch_id' => $branchId,
                    'ingredient_amt' => $request->input('ingredientAmt'),
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);


                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
            });

            return redirect()->intended('/ingredient')->with('status', $response->statusCode);

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration. ' . $e->getMessage();

            return redirect()->intended('/ingredient')->with('status', $response->message);

        }
    }

    private static function GenerateIngredientCode()
    {
        $lastIngredientCode = DB::table('ingredients')
            ->orderBy('ingredient_code', 'desc')
            ->first()
            ->ingredient_code ?? null;


        if ($lastIngredientCode == null) {
            $newIngredientCode = 'IG0000001';
        } else {
            $lastIngredientCodeNum = (int) substr($lastIngredientCode, 2);

            $newNumber = ++$lastIngredientCodeNum;

            $newIngredientCode = 'IG' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }

        return $newIngredientCode;
    }

    public function showIngredient()
    {
        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('ingredient', compact('tenant')); // Pass tenant variable to view
    }
}
