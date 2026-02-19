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
        $categorias = Categoria::all();
        
        if (Auth::user()->tipo === 'admin') {
            return view('admin.produtos', compact('produtos', 'categorias'));
        }
        return view('user.produtos', compact('produtos', 'categorias'));
    }

    public function show(Produto $produto)
    {
        return view('produto', compact('produto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'foto_produto' => ['required', 'image', 'max:2048'],
            'preco' => ['required', 'numeric'],
            'quantidade' => ['required', 'integer'],
        ]);

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'foto_produto' => $request->foto_produto,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'status' => $request->quantidade > 0 ? 'disponivel' : 'indisponivel',
            'id_vendedor' => Auth::id(),
            'id_categoria' => $request->id_categoria,
        ]);

        return Redirect::route('user.produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'foto_produto' => $request->foto_produto,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'status' => $request->quantidade > 0 ? 'disponivel' : 'indisponivel',
            'id_categoria' => $request->id_categoria,
        ]);

        return Redirect::route('user.produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return Redirect::route('user.produtos.index')->with('success', 'Produto deletado com sucesso!');
    }
}
