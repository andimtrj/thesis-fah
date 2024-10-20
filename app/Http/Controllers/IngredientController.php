<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Metric;
use App\Models\Tenant;
use App\Models\Ingredient;
use App\Models\MetricGroup;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
                'max:8',]
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
                    'ingredient_amt' => 0,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);


                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
            });

            return redirect()->intended('/ingredient')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/ingredient')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
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

    public function DetailIngredientPage($id){


        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $ingredient = Ingredient::findOrFail($id);
            $metricGroups = MetricGroup::get();
            $metrics = Metric::get();
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
        } else {
            throw new \Exception("Tenant Code Is Null");
        }


        // Pass the branch to the view
        return view('components.ingredient.edit-ingredient', compact('ingredient', 'metricGroups', 'metrics', 'tenant', 'branches'));
    }

    public function UpdateIngredient(Request $request, $id){
        $validatedData = Validator::make($request->all(), [
            'ingredientName' => 'required|string|max:255',
            'branchCode' => 'required|string|max:255|exists:branches,branch_code',
            'metricCode' => 'required|string|max:255|exists:metrics,metric_code'
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // dd($validatedData);

        try{
            DB::transaction(function () use ($request, $id, &$response) {
                $ingredient = Ingredient::findOrFail($id);

                $metric = $ingredient->metric;

                $ingredient = $this->validateIngredientMetric($request, $ingredient, $metric);

                $ingredient->ingredient_name = $request->input('ingredientName');

                $branch = Branch::where('branch_code', '=', $request->input('branchCode'))->firstOrFail();
                $ingredient->branch()->associate($branch);

                $ingredient->save();
                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
            });

            return redirect()->intended('/ingredient')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/ingredient')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }
        return redirect()->intended('/ingredient')->with([
            'status' => $response->statusCode,
            'message' => $response->message,
        ]);
    }

    private function validateIngredientMetric(Request $request, $ingredient, $metric){


        if($request->input('metricCode') == $metric->metric_code){

            return $ingredient;

        }else{
            $newMetric = Metric::where('metric_code', '=', $request->input('metricCode'))->firstOrFail();

            $ingredient->metric()->associate($newMetric);

            return $ingredient;


            // New Metric Sequence No is Greater Than Current Metric Sequence No
            // if ($newMetric->metric_seq_no > $metric->metric_seq_no) {
            //     $metric_seq_no_diff = $newMetric->metric_seq_no - $metric->metric_seq_no;
            //     // dd($metric_seq_no_diff);
            //     $factor = pow(10, $metric_seq_no_diff);
            //     // dd($factor);
            //     $ingredient->curr_amt = bcdiv($ingredient->initial_amt, $factor, 2);  // 2 is the number of decimal places
            // }
            // // New Metric Sequence No is Less Than Current Metric Sequence No
            // elseif ($newMetric->metric_seq_no < $metric->metric_seq_no) {
            //     $metric_seq_no_diff = $metric->metric_seq_no - $newMetric->metric_seq_no;
            //     // dd($metric_seq_no_diff);

            //     $factor = pow(10, $metric_seq_no_diff);
            //     $ingredient->curr_amt = bcmul($ingredient->initial_amt, $factor, 2);  // 2 is the number of decimal places
            // }

        }
    }

    public function getMetrics($ingredient_code)
    {
        try{
            $ingredient = Ingredient::where('ingredient_code', $ingredient_code)->first();

            if ($ingredient) {
                // Get metrics for the same metric group
                $metric = $ingredient->metric;
                $metricGroupId = $metric->metric_group_id;
                if ($metricGroupId) {
                    // Get all metrics for the same metric group
                    $metrics = Metric::where('metric_group_id', '=', $metricGroupId)->get();

                    // Return the metrics as JSON
                    return response()->json(['metrics' => $metrics]);
                }
            }

            return response()->json(['metrics' => []], 404); // Return empty array if no metrics found

        }
        catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return response()->json(['response' => $response]);
        }
        // Find the ingredient with its metrics and their metric group
    }


}
