<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pessoas; // Alterado de 'Pessoa' para 'Pessoas'

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

        if (Auth::guard('pessoas')->attempt($credentials)) {
            // Autenticação bem-sucedida
            return redirect()->intended('listar-usuario');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput($request->only('email'));
    }



    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
