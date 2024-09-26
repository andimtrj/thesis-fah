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
                $response = $this->userController->RegisterTenantOwner($request);
                if ($response->statusCode == "200") {
                    $this->authController->Authenticate($request);
                    return redirect()->intended('/branch')->with('status', $response->message);
                } else {
                    return redirect('/')->withErrors($response->data)->withInput();
                }
            } catch (\Exception $e) {
                // Log or handle the exception
                return redirect('/')->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
    }
}
