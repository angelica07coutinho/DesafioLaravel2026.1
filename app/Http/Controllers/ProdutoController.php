<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProdutoController extends Controller
{
    public function homeIndex(Request $request)
    {
        $query = Produto::query();

        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('id_categoria', $request->categoria);
        }

        if ($request->has('busca') && $request->busca != '') {
            $busca = $request->busca;
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('id', 'like', "%{$busca}%");
            });
        }

        $produtos = $query->get();
        return view('home', compact('produtos'));
    }

    public function index(Request $request)
    {
        $query = Produto::query();
        if (Auth::user()->tipo === 'padrao') {
            $query->where('id_vendedor', Auth::id());
        }

        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('id_categoria', $request->categoria);
        }

        if ($request->has('busca') && $request->busca != '') {
            $busca = $request->busca;
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('id', 'like', "%{$busca}%");
            });
        }

        $produtos = $query->get();
        
        if (Auth::user()->tipo === 'admin') {
            return view('admin.produtos', compact('produtos'));
        }
        return view('user.produtos', compact('produtos'));
    }

    public function show(Produto $produto)
    {
        return view('produto', compact('produto'));
    }
}
