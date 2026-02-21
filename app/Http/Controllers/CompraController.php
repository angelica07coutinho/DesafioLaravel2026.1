<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\ItensCompra;
use App\Models\Pagamentos;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CompraController extends Controller
{
    public function checkout(Request $request)
    {
        $url = config('services.pagseguro.checkout_url');
        $token = config('services.pagseguro.token');

        $produto = Produto::findOrFail($request->id_produto);
        $quantidade = $request->quantidade ?? 1;

        $compra = Compra::create([
            'id_vendedor' => $produto->id_vendedor,
            'id_cliente' => Auth::id(),
            'total' => $produto->preco * $quantidade,
            'status' => 'pendente',
        ]);

        ItensCompra::create([
            'id_compra' => $compra->id,
            'id_produto' => $produto->id,
            'quantidade' => $quantidade,
            'preco' => $produto->preco,
        ]);

        $itens = [[
            'name' => $produto->nome,
            'quantity' => (int) $quantidade,
            'unit_amount' => (int) ($produto->preco * 100),
        ]];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->withoutVerifying()->post($url, [
            'reference_id' => (string) $compra->id,
            'items' => $itens,
            'customer' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ]);

        if ($response->successful()) {
            Pagamentos::create([
                'id_compra' => $compra->id,
                'reference_id' => $compra->id,
                'status' => 'aguardando_pagamento',
            ]);
            $pay_link = data_get($response->json(), 'links.1.href');
            return redirect()->away($pay_link);
        } else {
            return back()->with('error', 'Erro ao processar compra. Tente novamente.');
        }
    }

    public function index()
    {
        $compras = Compra::with(['itens.produto.categoria', 'itens.produto.vendedor'])->where('id_cliente', Auth::id())->get();
        return view('user.compras', compact('compras'));
    }
}
