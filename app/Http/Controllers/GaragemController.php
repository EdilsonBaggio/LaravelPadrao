<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Garagem;
use App\Models\Pessoas;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class GaragemController extends Controller
{
    public function lista()
    {
        $userId = Auth::user()->id;
        $registros = Lista::where('id', $userId)->whereNull('deleted_at')->get();
        return view('cadastro-garagem', compact('registros'));
    }

    public function garagem(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'qtd_vagas' => 'required|string|max:255',
            'usuario_id' => 'required|string|max:255',
        ]);

        $garagem = new Garagem();
        $garagem->nome = $validatedData['nome'];
        $garagem->qtd_vagas = $validatedData['qtd_vagas'];
        $garagem->usuario_id = $validatedData['usuario_id'];
        $garagem->save();
        return redirect()->route('listar-garagem')->with('success', 'Garagem cadastrada com sucesso!');
    }

    // public function garagem(Request $request)
    // {
    //     $usuarioId = $request->input('usuario_id');

    //     $garagensCount = Garagem::where('usuario_id', $usuarioId)->count();

    //     if ($garagensCount >= 2) {
    //         $usuario = Pessoas::find($usuarioId);
    //         if (!$usuario->pagamento_liberado) {
    //             return redirect()->route('stripe-pagamento')->withErrors([
    //                 'error' => 'Você atingiu o limite de 2 garagens. Realize o pagamento para desbloquear mais vagas.',
    //             ]);
    //         }
    //     }

    //     $validatedData = $request->validate([
    //         'nome' => 'required|string|max:255',
    //         'qtd_vagas' => 'required|string|max:255',
    //         'usuario_id' => 'required|string|max:255',
    //     ]);

    //     $garagem = new Garagem();
    //     $garagem->nome = $validatedData['nome'];
    //     $garagem->qtd_vagas = $validatedData['qtd_vagas'];
    //     $garagem->usuario_id = $validatedData['usuario_id'];
    //     $garagem->save();

    //     return redirect()->route('listar-garagem')->with('success', 'Garagem cadastrada com sucesso!');
    // }

    // public function stripePagamento(Request $request)
    // {
    //     $stripe = new StripeClient(env('STRIPE_SECRET'));

    //     $session = $stripe->checkout->sessions->create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [[
    //             'price_data' => [
    //                 'currency' => 'brl',
    //                 'product_data' => [
    //                     'name' => 'Desbloqueio de novas garagens',
    //                 ],
    //                 'unit_amount' => 5000, 
    //             ],
    //             'quantity' => 1,
    //         ]],
    //         'mode' => 'payment',
    //         'success_url' => route('stripe-sucesso', ['usuario_id' => $request->input('usuario_id')]),
    //         'cancel_url' => route('stripe-cancelamento'),
    //     ]);

    //     return redirect($session->url);
    // }

    // public function stripeSucesso(Request $request)
    // {
    //     $usuario = Pessoas::find($request->input('usuario_id'));
    //     $usuario->pagamento_liberado = true; 
    //     $usuario->save();

    //     return redirect()->route('listar-garagem')->with('success', 'Pagamento realizado com sucesso! Você pode criar mais garagens.');
    // }

    public function atualizar(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'qtd_vagas' => 'required|string|max:255',
            'usuario_id' => 'required|string|max:255',
        ]);

        try {
            $garagem = Garagem::findOrFail($id);
        
            $garagem->nome = $validatedData['nome'];
            $garagem->qtd_vagas = $validatedData['qtd_vagas'];
            $garagem->usuario_id = $validatedData['usuario_id'];
            $garagem->save();

            return redirect()->route('listar')->with('success', 'Garagem atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar a garagem.');
        }
    }

    public function editar($id)
    {
        $garagem = Garagem::findOrFail($id);
        return view('editar-garagem', compact('garagem'));
    }

}