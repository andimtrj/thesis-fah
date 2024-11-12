<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UsageTrxH;
use Illuminate\Support\Facades\Auth;

class UsagePageController extends Controller
{
    public function ShowAddUsagePage(){
        $authTenantId = Auth::user()->tenant_id;
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
            $queryProducts = Product::with('branch')
                                     ->where('tenant_id', '=', $authTenantId);

            if(Auth::user()->branch_id){
                $queryProducts->where('branch_id', '=', Auth::user()->branch_id);
            }
            $products = $queryProducts->get();
            return view('components.usage.add-usage', compact('tenant', 'branches', 'products'));
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

    }

    public function ShowUsagePage(Request $request){
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
                $usages = UsageTrxH::GetPagingUsageTrx($request)->withQueryString();
                return view('usage', compact('tenant', 'branches', 'usages', 'formSubmitted')); // Pass tenant variable to view

            }
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('usage', compact('tenant', 'branches', 'formSubmitted')); // Pass tenant variable to view

    }
}
