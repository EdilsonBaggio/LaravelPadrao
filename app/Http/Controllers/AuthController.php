<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
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
        // Validar o e-mail
        $request->validate(['email' => 'required|email']);

        // Verificar se o e-mail existe na tabela pessoas
        $email = $request->input('email');
        $pessoa = Pessoas::where('email', $email)->first();

        if (!$pessoa) {
            return back()->withErrors(['email' => 'Este e-mail não está registrado.']);
        }

        // Enviar link de redefinição de senha se o email foi encontrado
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                // Acessando o modelo Pessoa em vez do modelo User
                $pessoa = Pessoas::where('email', $user->email)->first();

                if ($pessoa) {
                    // Atualizando a senha da pessoa
                    $pessoa->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    
                    $pessoa->save();

                    event(new PasswordReset($pessoa));
                }
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    
    public function logout()
    {
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken(); 
        return redirect('/');
    }

}
