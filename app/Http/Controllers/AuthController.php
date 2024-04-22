<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Verifica as credenciais na tabela 'pessoas'
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Autenticação bem-sucedida
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput($request->only('email'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
