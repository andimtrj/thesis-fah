<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function Authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return response()->json(['message' => 'Login Successful']);
        }

        return response()->json(['message' => 'Login Failed'], 500);
    }
}
