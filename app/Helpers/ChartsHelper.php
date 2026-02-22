<?php

use App\Models\Compra;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

if (!function_exists('gerarGraficoVendasPorMes')) {
    function gerarGraficoVendasPorMes()
    {
        $chart_options = [
            'chart_title' => 'Número de Vendas',
            'model' => Compra::class,
            'chart_type' => 'line',
            'report_type' => 'group_by_date',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_color' => '160,102,166',
            'where_raw' => isPadrao() ? 'id_vendedor = ' . Auth::id() : '',
            'filter_period' => 'year',
            'date_format' => 'M Y'
        ];

        return new LaravelChart($chart_options);
    }
}

if (!function_exists('gerarGraficoProdutosCadastrados')) {
    function gerarGraficoProdutosCadastrados()
    {
        $chart_options = [
            'chart_title' => 'Produtos Cadastrados',
            'model' => Produto::class,
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_color' => '160,102,166',
            'filter_period' => 'year',
            'date_format' => 'M Y'
        ];

        return new LaravelChart($chart_options);
    }
}
