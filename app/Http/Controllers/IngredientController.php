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
use App\Models\MetricGroup;
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
                'max:8',],
            'ingredientAmt' => 'required'
        ]);
        if ($validator->fails()) {
            dd($validator);

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

    public function showIngredientPage(Request $request)
    {
        $formSubmitted = $request->has('branchCode') || $request->has('ingredientCode') || $request->has('ingredientName');
        $authTenantId = Auth::user()->tenant_id;
        // dd($formSubmitted);
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            if($formSubmitted){
                $ingredients = Ingredient::GetPagingIngredient($request)->withQueryString();
                return view('ingredient', compact('tenant', 'branches', 'ingredients', 'formSubmitted')); // Pass tenant variable to view

            }
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('ingredient', compact('tenant', 'branches', 'formSubmitted')); // Pass tenant variable to view
    }

    public function showAddIngredientPage(){
        $metricGroups = MetricGroup::get();
        $metrics = Metric::get();

        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
        } else {
            throw new \Exception("Tenant Code Is Null");
        }


        return view('components.ingredient.add-ingredient', compact('metricGroups', 'metrics', 'tenant', 'branches'));
    }
}
