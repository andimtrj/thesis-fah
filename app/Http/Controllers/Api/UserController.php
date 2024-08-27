<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TenantController;

class UserController extends Controller
{

    protected $tenantController;
    protected $roleController;
    protected $branchController;

    public function __construct(TenantController $tenantController, RoleController $roleController, BranchController $branchController)
    {
        $this->branchController = $branchController;
        $this->tenantController = $tenantController;
        $this->roleController = $roleController;
    }
//#region Register
    public function RegisterTenantOwner(Request $request){
        $validator = Validator::make($request->all(), [
<<<<<<< HEAD
            // 'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns',
=======
            'email' => 'required|email:rfc,dns|unique:users,email',
>>>>>>> b33e8cf9af32b44501d139bd3ab7c0e17f786944
            'password' => 'required|string|min:8',
            'phoneNumber' => 'required|string|max:16',
            'tenantName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'roleCode' => 'required|string|in:TO',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zipCode' => 'required|string|max:255'
        ]);
        date_default_timezone_set(config('constants.DEFAULT_TIMEZONE'));

        $request['emailVerifiedTime'] = date('Y-m-d H:i:s');
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            DB::transaction(function() use($request, &$response){
                $tenant = $this->tenantController->CreateTenant($request);

                $role = Role::where('role_code', $request->roleCode)->firstOrFail();
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone_number' => $request->phoneNumber,
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'role_id' => $role->id,
                    'tenant_id' => $tenant->id,
                    'email_verified_at'=> $request->emailVerifiedTime
                ]);

                $token =  $user->createToken('auth_token')->plainTextToken;

                $response = response()->json([
                                'data' => $user,
                                'access_token' => $token,
                                'token_type' => 'Bearer'
                            ], 200);
            });

            return $response;

        }catch(\Exception $e){
            return response()->json(['error' => 'An Error Ocurred during Tenant Owner Registration'], 500);
        }
    }

    public function RegisterBranchAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8',
            'phoneNumber' => 'required|string|max:16',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'roleCode' => 'required|string|in:TO',
            'branchCode' => 'required|string|max:255|exists:branches,branch_code',
            'tenantCode' => 'required|string|max:255|exists:tenants,tenant_code'
        ]);

        $request['emailVerifiedTime'] = date('Y-m-d H:i:s');
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        try{
            $tenantOwner = $this->getUserInfoByToken($request);
            $tenantOwnerTenantId = $tenantOwner->tenant_id;

            $branch = Branch::GetBranchByBranchCode($request->branchCode);
            $branchTenantId = $branch->tenant_id;

            $tenantId = Tenant::GetTenantIdByTenantCode($request->tenantCode);

            if($tenantId == $tenantOwnerTenantId && $tenantId == $branchTenantId){
                $request->merge(['tenantId' => $tenantId],
                                ['branchId' => $branch->id]);

                DB::transaction(function() use($request ,&$response){
                    $role = Role::where('role_code', $request->roleCode)->firstOrFail();
                    $user = User::create([
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'phone_number' => $request->phoneNumber,
                        'first_name' => $request->firstName,
                        'last_name' => $request->lastName,
                        'role_id' => $role->id,
                        'tenant_id' => $request->tenantId,
                        'branch_id' => $request->branchId,
                        'email_verified_at'=> $request->emailVerifiedTime
                    ]);
                    $token =  $user->createToken('auth_token')->plainTextToken;

                    $response = response()->json([
                                    'data' => $user,
                                    'access_token' => $token,
                                    'token_type' => 'Bearer'
                                ], 200);
                });

                return $response;
            }
            else
            {
                return response()->json(['error' => 'Tenant Not Match'], 500);
            }


        }catch(\Exception $e){

        }

    }
//#endregion

    public static function getUserInfoByToken(Request $request)
    {
        // Extract token from Authorization header
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

<<<<<<< HEAD
    private function RegisterTenantOwner(Request $request, Tenant $tenant){
        $roleId = $this->roleController->GetRoleId($request->roleCode);
        $user = User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phoneNumber,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'role_id' => $roleId,
            'tenant_id' => $tenant->id,
            'email_verified_at'=> $request->emailVerifiedTime
        ]);
=======
        // Find the token record in the database
        $tokenRecord = PersonalAccessToken::where('token', hash('sha256', $token))->first();
>>>>>>> b33e8cf9af32b44501d139bd3ab7c0e17f786944

        if (!$tokenRecord) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        // Retrieve the associated user
        return $user = $tokenRecord->tokenable; // This retrieves the user (or model) associated with the token

    }


}
