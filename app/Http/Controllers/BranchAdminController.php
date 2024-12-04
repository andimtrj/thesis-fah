<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchAdminController extends Controller
{
    public function showBranchAdminPaging(Request $request, $branchId)
    {
        $branch = Branch::find($branchId);
        if($branch)
        {
            $formSubmitted = $request->has('name') || $request->has('username');
            $authTenantId = Auth::user()->tenant_id;

            if ($authTenantId) {
                $branchAdmins = User::GetPagingBranchAdmin($request, $branchId)->withQueryString(); // Call the Model method here

            } else {
                abort(500, "Invalid Tenant");
            }
            return view('branchAdmin', compact('branchAdmins', 'formSubmitted', 'branch'));

        }
        else{
            abort(404, 'Invalid Branch');
        }
    }

    public function showAddBranchAdminPage($branchId){
        $authTenantId = Auth::user()->tenant_id;
        $branch = Branch::find($branchId)->firstOrFail();
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);

            return view('components.branch-admin.add-branch-admin', compact('branch', 'authTenantId'));
        } else {
            abort(500, "Invalid Tenant");
        }

    }

    public function showEditBranchAdminPage($branchAdminId){
        $authTenantId = Auth::user()->tenant_id;
        $branchAdmin = User::find($branchAdminId);
        $branch = Branch::find($branchAdmin->branch_id);

        if ($authTenantId && $branch) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);

            return view('components.branch-admin.edit-branch-admin', compact('branchAdmin', 'authTenantId', 'branch'));
        } else {
            abort(404, "Invalid");
        }

    }

}
