<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\TenantController;

class BranchController extends Controller
{
    protected $userController;
    protected $tenantController;

    public function __construct(TenantController $tenantController)
    {
        $this->tenantController = $tenantController;
    }

    // #region Insert Branch
    public function CreateBranch(Request $request){
        $validator = Validator::make($request->all(), [
            'branchName' => 'required|string|max:255',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'tenantOwnerId' => 'required|integer|exists:users,id',
            'branchAddress' => 'required|string|max:255',
            'branchCity' => 'required|string|max:255',
            'branchProvince' => 'required|string|max:255',
            'branchZipCode' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            $response = null;

            DB::transaction(function() use($request, &$response){
                $user = User::find($request->tenantOwnerId);
                $branchCode = $this->GenerateBranchCode();
                $tenantId = Tenant::GetTenantIdByTenantCode($request);

                $branch = Branch::create([
                    'branch_code' => $branchCode,
                    'branch_name' => $request->branchName,
                    'tenant_id' => $tenantId,
                    'address' => $request->branchAddress,
                    'city' => $request->branchCity,
                    'provice' => $request->branchProvince,
                    'zip_code' => $request->branchZipCode,
                    'created_by' => $user->email,
                    'updated_by' => $user->email,
                ]);

                $response = response()->json($branch, 200);
            });

            return $response;

        }catch(\Exception $e){
            return response()->json(['error' => 'An Error Ocurred during Branch Admin Registration'], 500);
        }
    }
    // #endregion

    // #region Generate Branch Code
    private static function GenerateBranchCode(){
        $lastBranchCode = DB::table('branches')
        ->orderBy('branch_code', 'desc')
        ->first()
        ->branch_code ?? null;


        if($lastBranchCode == null){
            $newBranchCode = 'B0000001';
        }
        else{
            $lastBranchCodeNum = (int) substr($lastBranchCode, 1);

            $newNumber = ++$lastBranchCodeNum;

            $newBranchCode = 'B' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }

        return $newBranchCode;

    }
    // #endregion

    // #region Get
    // #endregion
}
