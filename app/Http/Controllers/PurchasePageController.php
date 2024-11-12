<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Metric;
use App\Models\PurchaseTrxH;
use Illuminate\Support\Facades\Auth;

class PurchasePageController extends Controller
{
    public function ShowAddPurchasePage(){
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
            return view('components.purchase.add-purchase', compact('tenant', 'branches', 'ingredients', 'metrics'));
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

    }

    public function ShowPurchasePage(Request $request){
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
                $purchases = PurchaseTrxH::GetPagingPurchaseTrx($request)->withQueryString();
                return view('purchase', compact('tenant', 'branches', 'purchases', 'formSubmitted')); // Pass tenant variable to view

            }
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('purchase', compact('tenant', 'branches', 'formSubmitted')); // Pass tenant variable to view

    }

}
