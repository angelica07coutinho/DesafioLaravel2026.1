<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('id_categoria', $request->categoria);
        }

        if ($request->has('busca') && $request->busca != '') {
            $busca = $request->busca;
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%");
            });
        }

        $produtos = $query->get();
        return view('home', compact('produtos'));
    }

    public function show(Produto $produto)
    {
        return view('produto', compact('produto'));
    }
}
