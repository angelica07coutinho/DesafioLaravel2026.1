<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p><strong>Período:</strong>
        @if ($periodo == '1mes')
        {{ __('Último Mês') }}
        @elseif ($periodo == '6meses')
        {{ __('Últimos 6 Meses') }}
        @elseif ($periodo == '1ano')
        {{ __('Último Ano') }}
        @else
        {{ __('Todas as Datas') }}
        @endif
    </p>
    @if ($vendas->isEmpty())
        <p>Nenhuma venda encontrada neste período.</p>
    @else
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>ID Produtos</th>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                <td>
                    @foreach ($venda->itens as $item)
                        {{ $item->produto->id }}@if (!$loop->last), @endif
                    @endforeach
                </td>
                <td>{{ $venda->vendedor->name }}</td>
                <td>{{ $venda->cliente->name }}</td>
                <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $venda->status)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>