<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\TenantController;
use App\Models\DeletedUserModel;

class UserController extends Controller
{
    private $tenantController;
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
            'username' => 'required|string|unique:users,username',
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
        if($validator->fails()) {
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            // Flatten the error messages and get only the values
            $response->message = "Invalid Registration : " . implode(', ', $validator->errors()->all());
            $response->data = $validator;

            return redirect()->intended('/')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
        }

        try{
            DB::transaction(function() use($request, &$response){
                $tenant = $this->tenantController->CreateTenant($request);
                $role = Role::where('role_code', $request->roleCode)->firstOrFail();
                User::create([
                    'username' => $request->username,
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
            $this->authController->Authenticate($request);

            return redirect()->intended('/dashboard')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }
    }
    public function RegisterBranchAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8',
            'phoneNumber' => 'required|string|max:16',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'roleCode' => 'required|string|in:BA',
            'branchId' => 'required|string|max:255|exists:branches,id',
            'tenantId' => 'required|string|max:255|exists:tenants,id'
        ]);

        $request['emailVerifiedTime'] = date('Y-m-d H:i:s');
        if($validator->fails()){
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            $response->message = $validator->errors();

            return redirect()->back()->withErrors($validator)->withInput()
                    ->with([
                        'status' => $response->statusCode,
                        'message' => $response->message
                        ]
                    );

        }

        try{

            DB::transaction(function() use($request ,&$response){
                $role = Role::where('role_code', $request->roleCode)->select('id')->firstOrFail();

                User::create([
                    'username' => $request->username,
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

                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;

            });

            return redirect()->route('branch-admin', ['branchId' => $request->branchId])->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->back()->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }

    }
//#endregion

    public function UpdateBranchAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'branchAdminId' => 'required|integer|exists:users,id',
            'email' => 'required|email:rfc,dns',
            'phoneNumber' => 'required|string|max:16',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'roleCode' => 'required|string|in:BA',
            'branchId' => 'required|string|max:255|exists:branches,id',
            'tenantId' => 'required|string|max:255|exists:tenants,id'
        ]);

        $request['emailVerifiedTime'] = date('Y-m-d H:i:s');
        if($validator->fails()){
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            $response->message = $validator->errors();

            return redirect()->back()->withErrors($validator)->withInput()
                    ->with([
                        'status' => $response->statusCode,
                        'message' => $response->message
                        ]
                    );
        }

        try{

            DB::transaction(function() use($request ,&$response){

                $branchAdmin = User::find($request->input('branchAdminId'));
                $branchAdmin->email = $request->input('email');
                $branchAdmin->phone_number = $request->input('phoneNumber');
                $branchAdmin->first_name = $request->input('firstName');
                $branchAdmin->last_name = $request->input('lastName');
                $branchAdmin->save();

                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;

            });

            return redirect()->route('branch-admin', ['branchId' => $request->branchId])->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->back()->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);


        }


    }

    public function DeleteBranchAdmin($id){
        try{
            $branchAdmin = User::findOrFail($id);

            $user = Auth::user();

            DB::transaction(function () use ($user, $branchAdmin, &$response) {
                DeletedUserModel::create([
                    'username' => $branchAdmin->username,
                    'email' => $branchAdmin->email,
                    'role_id' => $branchAdmin->role_id,
                    'tenant_id' => $branchAdmin->tenant_id,
                    'branch_id' => $branchAdmin->branch_id,
                    'deleted_by' => $user->username,
                    'deleted_at'=> now()
                ]);

                $branchAdmin->forceDelete();

            });


            return redirect()->back()->with([
                'status' => '200',
                'message' => 'Branch Admin deleted successfully.',
            ]);

        } catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Delete : ' . $e->getMessage();

            return redirect()->intended('/branch-admin')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }
    }

}
