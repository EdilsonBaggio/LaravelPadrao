<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//importa a classe request do laravel (lida com solicitações HTTP)
use Illuminate\Support\Facades\Auth;//Importa a fachada auth do laravel(fornece metodos de autenticação para o usuario)
use App\Models\Pessoas; // Alterado de 'Pessoa' para 'Pessoas'

class AuthController extends Controller//herdando os metodos da classe controller
{
    public function showLoginForm()//defini um método chamado showLoginForm 
    {
        return view('auth.login');//Retorna a exibição do formulário de login
    }

    public function login(Request $request) //Defini um metodo chamado login(Request $request) que lida com os processos de login do usuario 
    {
        $credentials = $request->only('email', 'password');//Pega as credenciais de login(email e senha) dos dados enviados do formulário

        if (Auth::guard('pessoas')->attempt($credentials)) {// Verifica as credenciais na tabela 'pessoas'no banco de dados
           
            return redirect()->intended('listar-usuario'); //Se a autenticação for bem-sucedida ele vai para a página de listar-usuario automaticamente
        }

        return back()->withErrors(['email' => 'Os dados estão incorretos ou não existe usuário cadastrado.'])->withInput($request->only('email'));//Se a autenticação falhar, o usuário é redirecionado de volta para a página anterior (com uma mensagem de erro), e os dados do formulário (apenas o email) são repassados para que o usuário não precise digitá-los novamente.
    }

    public function logout()//Função para mostrar que o usuario esta logado na página
    {
        Auth::logout();//faz o logout do usuário atual
        session()->invalidate(); // Limpa a sessão
        session()->regenerateToken(); // Regenera o token,usado para proteger contra ataques de falsificação
        return redirect('/');//Depois que o logout é concluido com sucesso o usuario é redirecionado para página inicial '/'.
    }

}
