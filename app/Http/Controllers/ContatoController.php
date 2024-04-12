<?php

namespace App\Http\Controllers;

use App\Mail\PadraoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContatoController extends Controller
{
    public function send(Request $request){
        $nome = $request->nome;
        $email = $request->email;
        $assunto = $request->assunto;
        $mensagem = $request->mensagem;

        $rules = [
            "assunto" => "required",
            "email" => "required|email",
            "nome" => "required",
            "mensagem" => "required"
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back();
        }else{

            Mail::to(env("EMAIL_CONTATO"))->send(new padraoMail($nome, $email, $assunto, $mensagem));

            return redirect()->back();
        }
    }
}