<?php

namespace App\Http\Controllers\Api;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\RoleController;

class UserController extends Controller
{

    protected $tenantController;
    protected $roleController;

    public function __construct(TenantController $tenantController, RoleController $roleController)
    {
        $this->tenantController = $tenantController;
        $this->roleController = $roleController;
    }

    public function Register(Request $request){
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:8',
            'phoneNumber' => 'required|string|max:16',
            'tenantName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'roleCode' => 'required|string|max:5',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zipCode' => 'required|string|max:255'
        ]);
        date_default_timezone_set('Asia/Jakarta');

        $request['emailVerifiedTime'] = date('Y-m-d H:i:s');

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        try{
            if($request['roleCode'] == 'TO')
            {
                DB::transaction(function() use($request){
                    $tenant = $this->tenantController->CreateTenant($request);
                    return $this->RegisterTenantOwner($request, $tenant);
                });
            }
            else if($request['roleCode'] == 'BA')
            {
                // function Register Branch Admin
            }else{
                return response()->json(['error' => 'Invalid Role'], 500);
            }
        }catch(\Exception $e){
            return response()->json(['error' => 'An Error Ocurred during Registration'], 500);
        }


    }



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

        $token =  $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }


}
