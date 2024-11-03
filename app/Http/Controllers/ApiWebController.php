<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ApiWebController extends Controller
{
    private $userController;
    private $authController;
    public function __construct(UserController $userController, AuthController $authController)
    {
        $this->userController = $userController;
        $this->authController = $authController;
    }
    public function Registration(Request $request){
        if($request->roleCode == 'TO'){
            try {
                return $this->userController->RegisterTenantOwner($request);
            } catch (\Exception $e) {
                // Log or handle the exception
                return redirect()->intended('/')->with([
                    'status' => '500',
                    'message' => 'An Error Occurred During Registration : ' . $e->getMessage(),
                ]);
            }
        }
    }
}
