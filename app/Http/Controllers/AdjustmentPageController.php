<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Metric;
use App\Models\Tenant;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\AdjustmentTrxH;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdjustmentPageController extends Controller
{
    public function ShowAddAdjustmentPage(){
        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            $queryIngredients = Ingredient::with('branch')
                                            ->with('metric')
                                            ->where('tenant_id', '=', $authTenantId);
            $metrics = Metric::get();

            if(Auth::user()->branch_id){
                $queryIngredients->where('branch_id', '=', Auth::user()->branch_id);
            }
            $ingredients = $queryIngredients->get();
            return view('components.adjustment.add-adjustment', compact('tenant', 'branches', 'ingredients', 'metrics'));
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

    }

    public function ShowAdjustmentPage(Request $request){
        $formSubmitted = $request->has('trxNo') ||
                        $request->has('branchCode') ||
                        $request->has('startDate') ||
                        $request->has('endDate');

        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            if($formSubmitted){
                $adjustments = AdjustmentTrxH::GetPagingAdjustmentTrx($request)->withQueryString();
                return view('adjustment', compact('tenant', 'branches', 'adjustments', 'formSubmitted')); // Pass tenant variable to view

            }
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('adjustment', compact('tenant', 'branches', 'formSubmitted')); // Pass tenant variable to view

    }
}
