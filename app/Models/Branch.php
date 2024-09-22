<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function GetBranchByBranchCode(Request $request){
        $validator = Validator::make($request->all(), [
            'branchCode' => 'required|string|max:255|exists:branches,branch_code'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        return Branch::where('branch_code', $request->branchCode)->firstOrFail();

    }

    public function GetPagingBranch(Request $request){
        if($request->input('tenantCode')){
            $paramTenantCode = $request->input('tenantCode');
            $query = Branch::join('tenants', 'branches.tenant_id', '=', 'tenants.id')
            ->leftJoin('users', function ($join) {
                $join->on('branches.id', '=', 'users.branch_id');
            })
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.role_code', "BA")
            ->where('tenants.tenant_code', $paramTenantCode);
        }else{
            throw new \Exception("Tenant Code Is Null");
        }

        if($request->input('branchCode')){
            $paramBranchCode = $request->input('branchCode', null);
            $query->where('branches.branch_code', $paramBranchCode);
        }

        if($request->input('branchName')){
            $paramBranchName = $request->input('branchName', null);
            $query->where('branches.branch_name', $paramBranchName);
        }

        $branches = $query->select(
            'branches.branch_code as branch_code',
            'branches.branch_name as branch_name',
            DB::raw('COUNT(users.id) as branch_admin_count') // Count of users with branch_admin role
        )
        ->groupBy('branches.id', 'branches.branch_code', 'branches.branch_name') // Group by branch to aggregate the count
        ->orderBy('branches.created_at', 'desc')
        ->paginate(10);

        return view('branch', compact('branches', 'paramBranchCode', 'paramBranchName', 'paramTenantCode'));
    }
}
