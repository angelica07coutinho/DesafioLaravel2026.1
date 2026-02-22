<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\ItensCompra;
use App\Models\Pagamentos;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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

    public function index(Request $request)
    {
        $query = Compra::with(['itens.produto.categoria', 'itens.produto.vendedor'])
            ->where('id_cliente', Auth::id());

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('periodo') && $request->periodo != '') {
            switch ($request->periodo) {
                case '1mes':
                    $query->where('created_at', '>=', now()->subMonth());
                    break;
                case '6meses':
                    $query->where('created_at', '>=', now()->subMonths(6));
                    break;
                case '1ano':
                    $query->where('created_at', '>=', now()->subYear());
                    break;
            }
        }

        $compras = $query->orderBy('created_at', 'desc')
            ->paginate(5)->onEachSide(1)->withQueryString();
        return view('user.compras', compact('compras'));
    }

    public function vendas(Request $request)
    {
        if (Auth::user()->tipo === 'padrao') {
            $query = Compra::with(['itens.produto.categoria', 'itens.produto.vendedor'])
                ->where('id_vendedor', Auth::id());
        } else if (Auth::user()->tipo === 'admin') {
            $query = Compra::with(['itens.produto.categoria', 'itens.produto.vendedor']);
        } else {
            return redirect()->route('home');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('periodo') && $request->periodo != '') {
            switch ($request->periodo) {
                case '1mes':
                    $query->where('created_at', '>=', now()->subMonth());
                    break;
                case '6meses':
                    $query->where('created_at', '>=', now()->subMonths(6));
                    break;
                case '1ano':
                    $query->where('created_at', '>=', now()->subYear());
                    break;
            }
        }

        $vendas = $query->orderBy('created_at', 'desc')
            ->paginate(10)->onEachSide(1)->withQueryString();



        if (Auth::user()->tipo === 'admin') {
            $chartP = gerarGraficoProdutosCadastrados();
            $chartV = gerarGraficoVendasPorMes();
            return view('dashboard', compact('vendas', 'chartP', 'chartV'));
        } else if (Auth::user()->tipo === 'padrao') {
            $chart = gerarGraficoVendasPorMes();
            return view('user.vendas', compact('vendas', 'chart'));
        }
    }
}
