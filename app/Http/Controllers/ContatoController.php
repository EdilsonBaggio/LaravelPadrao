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

    // public function enviarOneCode(Request $request)
    // {
    //     // Validar os parâmetros recebidos
    //     $validated = $request->validate([
    //         'sistema' => 'required|string',
    //         'numero' => 'required|string',
    //         'mensagem' => 'required|string',
    //     ]);

    //     // Extrair os parâmetros
    //     // $sistema = $validated['sistema'];
    //     // $numero = $validated['numero'];
    //     // $mensagem = $validated['mensagem'];

    //     $sistema = 'Padrão laravel';
    //     $numero = '11991680375';
    //     $mensagem = 'Teste';

    //     // Montar o objeto para envio
    //     $dadosEnvio = [
    //         'body' => $sistema, $numero, $mensagem,
    //         'connectionFrom' => 0,
    //     ];

    //     $client_secret = env('ONECODE_CLIENT_SECRET');

    //     // Enviar a requisição para a API do OneCode
    //     try {
    //         $client = new \GuzzleHttp\Client();
    //         $response = $client->request('POST', 'https://api-kasi.onecode.chat/api/send/' . $numero, [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $client_secret,
    //                 'Content-Type' => 'application/json',
    //                 'accept' => 'application/json',
    //             ],
    //             'json' => $dadosEnvio,
    //         ]);

    //         if ($response->getStatusCode() == 200) {
    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'Mensagem enviada com sucesso para o OneCode',
    //                 'response' => json_decode($response->getBody(), true)
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Falha ao enviar mensagem para o OneCode',
    //                 'response' => json_decode($response->getBody(), true)
    //             ], $response->getStatusCode());
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Ocorreu um erro ao enviar a mensagem: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function enviarOneCode(Request $request)
    {
        $sistemaNome = 'Tiigo';
        $numeroTelefone = '+5511957933300'; // Certifique-se de que este número está no formato correto
        $mensagemSistema = 'Teste envio dados OneCode';

        if (!preg_match('/^\+\d{1,15}$/', $numeroTelefone)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Número de telefone inválido',
            ], 400);
        }

        $dadosEnvio = [
            'recipient_type' => $sistemaNome,
            'to' => $numeroTelefone,
            'type' => 'text',
            'text' => [
                'body' => $mensagemSistema,
            ],
            'connectionFrom' => 0,
        ];

        $client_secret = env('ONECODE_CLIENT_SECRET');

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://api-kasi.onecode.chat/api/send/' . $numeroTelefone, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $client_secret,
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                ],
                'json' => $dadosEnvio,
                'allow_redirects' => false,
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);

            if ($statusCode == 200) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Mensagem enviada com sucesso para o OneCode',
                    'dados' => $dadosEnvio,
                    'response' => $responseData
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Falha ao enviar mensagem para o OneCode',
                    'response' => $responseData
                ], $statusCode);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao enviar a mensagem: ' . $e->getMessage(),
                'response' => $dadosEnvio
            ], 500);
        }
    }
}