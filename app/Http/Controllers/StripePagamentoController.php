<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Pessoa;

class StripePagamentoController extends Controller
{
    /**
     * Exibe a página para iniciar o pagamento.
     */
    public function iniciarPagamento(Request $request)
    {
        $usuarioId = $request->input('usuario_id');

        if (!$usuarioId) {
            return redirect()->back()->withErrors('Usuário não encontrado.');
        }

        return view('stripe.pagamento', compact('usuarioId')); // Crie a view stripe/pagamento.blade.php para exibir o botão de pagamento.
    }

    /**
     * Cria uma sessão de pagamento no Stripe.
     */
    public function processarPagamento(Request $request)
    {
        $usuarioId = $request->input('usuario_id');

        if (!$usuarioId) {
            return redirect()->back()->withErrors('Usuário não encontrado.');
        }

        // Configurar o Stripe
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Criar a sessão de checkout
        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => 'Desbloqueio de novas garagens',
                    ],
                    'unit_amount' => 5000, // Preço em centavos (exemplo: R$50,00)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.sucesso', ['usuario_id' => $usuarioId]),
            'cancel_url' => route('stripe.cancelamento'),
        ]);

        return redirect($session->url);
    }

    /**
     * Lida com o sucesso do pagamento.
     */
    public function pagamentoSucesso(Request $request)
    {
        $usuarioId = $request->input('usuario_id');

        $pessoa = Pessoa::find($usuarioId);

        if (!$pessoa) {
            return redirect()->route('listar-garagem')->withErrors('Usuário não encontrado.');
        }

        // Atualiza a permissão do usuário
        $pessoa->pagamento_liberado = true;
        $pessoa->save();

        return redirect()->route('listar-garagem')->with('success', 'Pagamento realizado com sucesso! Agora você pode criar mais garagens.');
    }

    /**
     * Lida com o cancelamento do pagamento.
     */
    public function pagamentoCancelado()
    {
        return redirect()->route('listar-garagem')->withErrors('Pagamento cancelado. Tente novamente.');
    }
}
