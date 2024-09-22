<?php

namespace App\Http\Controllers\Api;

use App\DTO\BaseResponseObj;
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
use App\Http\Controllers\AuthController;

class UserController extends Controller
{

    private $tenantController;
    private $roleController;
    private $branchController;
    private $authController;

    public function __construct(TenantController $tenantController
                                , AuthController $authController)
    {
        $this->tenantController = $tenantController;
        $this->authController = $authController;
    }
//#region Register
    public function RegisterTenantOwner(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:users,email',
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
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            $response->message = $validator->errors();
            $response->data = $validator;

            return $response;
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

                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
            });

            return $response;

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration. ' . $e->getMessage();

            return $response;

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
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            $response->message = $validator->errors();

            return $response;

        }

        try{
            $tenantOwner = $this->getUserInfoByToken($request);
            if($tenantOwner->statusCode){
                return $tenantOwner;
            }

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
                $response = new BaseResponseObj();
                $response->statusCode = "500";
                $response->message = 'Tenant Not Match!';

                return $response;
            }


        }catch(\Exception $e){

        }

    }
//#endregion

    public static function getUserInfoByToken(Request $request)
    {
        // Extract token from Authorization header
        $token = $request->bearerToken();
        $response = new BaseResponseObj();

        if (!$token) {
            $response->statusCode = "401";
            $response->message = 'Token not provided!';

            return $response;
        }

        // Find the token record in the database
        $tokenRecord = PersonalAccessToken::where('token', hash('sha256', $token))->first();

        if (!$tokenRecord) {
            $response->statusCode = "401";
            $response->message = 'Invalid Token!';

            return $response;
        }

        // Retrieve the associated user
        $user = $tokenRecord->tokenable;
        return $user; // This retrieves the user (or model) associated with the token

    }


}
