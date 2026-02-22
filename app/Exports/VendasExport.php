<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class VendasExport implements FromQuery, WithHeadings, WithMapping
{
    protected $filtros;
    
    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }

    public function query()
    {
        $query = Compra::query()
            ->with(['itens.produto', 'cliente'])
            ->orderBy('created_at', 'desc');

        if (isset($this->filtros['periodo']) && $this->filtros['periodo'] != '') {
            switch ($this->filtros['periodo']) {
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

        if (isset($this->filtros['status']) && $this->filtros['status'] != '') {
            $query->where('status', $this->filtros['status']);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cliente',
            'Produtos (qtd)',
            'Vendedor',
            'Total (R$)',
            'Status',
            'Data',
        ];
    }

    public function map($compra): array
    {
        $produtos = $compra->itens->map(function($item) {
            return $item->produto->nome . " (x" . $item->quantidade . ")";
        })->implode(', ');

        return [
            $compra->id,
            $compra->cliente->name,
            $produtos,
            $compra->vendedor->name,
            number_format($compra->total, 2, ',', '.'),
            ucfirst(str_replace('_', ' ', $compra->status)),
            $compra->created_at->format('d/m/Y'),
        ];
    }
}
