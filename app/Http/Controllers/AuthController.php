<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Tenant;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function Authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|exists:users,email',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return redirect('/login')->withErrors($validator)->withInput();
        }
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $response = new BaseResponseObj();
            $response->statusCode = '400';
            $response->message = 'Authentication Failed!';

            return redirect()->back()->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ])->withInput();
        }

        if(Auth::attempt($credentials)){

            try{
                $request->session()->regenerate();
                $authTenantId = Auth::user()->tenant_id;
                $authTenant = Tenant::find($authTenantId);
                $authTenantCode = $authTenant->tenant_code;

                session(
                    [
                        'tenant_code' => $authTenantCode
                    ]
                );

                $authBranchId = Auth::user()->branch_id;
                $authBranch = Branch::find($authBranchId);

                if($authBranch){
                    $authBranchCode = $authBranch->branch_code ?? "";
                    session(
                        [
                            'branch_code' => $authBranchCode
                        ]
                    );
                }

                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Login Success!';

                return redirect()->intended('/branch')->with([
                    'status' => $response->statusCode,
                    'message' => $response->message,
                ]);

            }catch(\Exception $e){
                $response = new BaseResponseObj();
                $response->statusCode = '500';
                $response->message = 'An Error Occurred During Authentication : ' . $e->getMessage();

                return redirect()->intended('/')->with([
                    'status' => $response->statusCode,
                    'message' => $response->message,
                ]);


            }
        }

        return redirect('/login')->withErrors($validator)->withInput();
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
