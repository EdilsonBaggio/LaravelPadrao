<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneCodeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function enviarOneCode(Request $request)
    {
        $sistemaNome = 'Tiigo';
        $numeroTelefone = '5511991680375'; // Certifique-se de que este número está no formato correto
        $mensagemSistema = 'Teste de envio pelo Cafe usado como ponte para o Onecode';

        $dadosEnvio = [
            'to' => $numeroTelefone,
            'body' => $sistemaNome . "\n\n" . $mensagemSistema,
            'connectionFrom' => 0,
            'ticketStrategy' => 'create'
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
                'allow_redirects' => false, // Evita redirecionamentos automáticos
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
            // \Log::error('Erro ao enviar mensagem para o OneCode: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao enviar a mensagem: ' . $e->getMessage(),
                'response' => $dadosEnvio
            ], 500);
        }
    }
}
