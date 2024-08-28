<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\Pessoas; 

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('pessoas')->attempt($credentials)) {
            if (Auth::guard('pessoas')->user()->id == 1) { // Use user()->id to get the authenticated user's ID
                return redirect()->intended('listar-usuario');
            } else {
                return redirect()->intended('garagens');
            }
        }
        
        return back()->withErrors(['email' => 'Os dados estão incorretos ou não existe usuário cadastrado.'])->withInput($request->only('email'));
    }


    public function esqueci(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken(); 
        return redirect('/');
    }

}
