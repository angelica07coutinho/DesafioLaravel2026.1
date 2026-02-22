<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class ProdutoController extends Controller
{
    public function homeIndex(Request $request)
    {
        $query = Produto::query()
        ->where('status', 'disponivel')
        ->where('id_vendedor', '!=', Auth::id());

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

        $produtos = $query->paginate(8)->onEachSide(1)->withQueryString();
        return view('home', compact('produtos'));
    }

    public function index(Request $request)
    {
        if (isAdmin() && Route::currentRouteName() === 'user.produtos.index') {
            return redirect()->route('admin.produtos.index');
        }
        if (isPadrao() && Route::currentRouteName() === 'admin.produtos.index') {
            return redirect()->route('user.produtos.index');
        }

        $query = Produto::query();
        if (isPadrao()) {
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

        $produtos = $query->paginate(10)->onEachSide(1)->withQueryString();
        $categorias = Categoria::all();
        
        if (isAdmin()) {
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
            'foto_produto' => ['required', 'image'],
            'preco' => ['required', 'numeric'],
            'quantidade' => ['required', 'integer'],
        ]);

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'foto_produto' => $request->foto_produto->store('produtos', 'public'),
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
            'foto_produto' => $request->foto_produto ? $request->foto_produto->store('produtos', 'public') : $produto->foto_produto,
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

        if (isAdmin()) {
            return Redirect::route('admin.produtos.index')->with('success', 'Produto deletado com sucesso!');
        }
        return Redirect::route('user.produtos.index')->with('success', 'Produto deletado com sucesso!');
    }
}
