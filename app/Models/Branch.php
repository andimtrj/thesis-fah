<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_code',
        'branch_name',
        'tenant_id',
        'address',
        'city',
        'province',
        'zip_code',
        'created_by',
        'updated_by'
    ];


    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot();

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

    public static function GetBranchIdByBranchCode(string $branchCode){

        $branch = Branch::where('branch_code', $branchCode)->firstOrFail();
        return $branch->id;
    }


    public static function GetPagingBranch(Request $request){

        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId) {
            $query = Branch::from('branches as b')
                ->join('tenants as t', 'b.tenant_id', '=', 't.id')
                ->leftJoin('users as u', 'b.id', '=', 'u.branch_id')
                ->leftJoin('roles as r', 'u.role_id', '=', 'r.id')
                // ->where('r.role_code', 'BA') // Apply the role filter here
                ->select('b.branch_code', 'b.branch_name', DB::raw('COUNT(u.id) as branch_admin_count'), 'b.id as id') // Selecting the required fields and count
                ->orderBy('b.created_at', 'desc')
                ->groupBy('b.id', 'b.branch_code', 'b.branch_name')
                ->where('b.tenant_id', '=', $authTenantId); // Grouping by the necessary fields

            // Apply filters if branchCode or branchName is provided
            if ($request->input('branchCode')) {
                $paramBranchCode = $request->input('branchCode', null);
                $query->where('b.branch_code', 'like', '%' . $paramBranchCode . '%');
            }

            if ($request->input('branchName')) {
                $paramBranchName = $request->input('branchName', null);
                $query->where('b.branch_name', 'like', '%' . $paramBranchName . '%');
            }

            $branches = $query->paginate(10); // Paginate the results
        } else {
            abort(500, "Invalid Tenant");
        }

        return $branches;
    }
}
