<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

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
            return redirect()->back()->withErrors([
                'error' => 'Invalid Login.',
            ])->withInput();
        }
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/branch');
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
