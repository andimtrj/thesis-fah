<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Tenant;
use App\DTO\BaseResponseObj;
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
            return redirect('/branch')->with('error', 'An error occurred: ' . $validator->messages());
        }

        try{
            $response = null;

            DB::transaction(function() use($request, &$response){
                $branchCode = $this->GenerateBranchCode();
                $tenantId = Tenant::GetTenantIdByTenantCode($request);

                Branch::create([
                    'branch_code' => $branchCode,
                    'branch_name' => $request->branchName,
                    'tenant_id' => $tenantId,
                    'address' => $request->branchAddress,
                    'city' => $request->branchCity,
                    'provice' => $request->branchProvince,
                    'zip_code' => $request->branchZipCode
                ]);

                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
            });

            return redirect()->intended('/branch')->with('status', $response['message']);

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration. ' . $e->getMessage();

            return redirect()->intended('/branch')->with('status', $response->message);

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
