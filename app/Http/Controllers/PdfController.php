<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function gerarPdfCompras(Request $request)
    {
        $query = Compra::with(['itens.produto.categoria', 'itens.produto.vendedor', 'vendedor'])
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

        $compras = $query->orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Relatório de Compras',
            'compras' => $compras,
            'periodo' => $request->periodo ?? 'todos',
            'status' => $request->status ?? 'todos',
        ];

        return generatePDF($data, 'pdf.compras');
    }
}
