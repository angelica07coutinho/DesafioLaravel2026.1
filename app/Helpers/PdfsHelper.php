<?php

use Barryvdh\DomPDF\Facade\Pdf;

if (!function_exists('generatePDF')) {
    function generatePDF($data, $view = 'pdf.invoice')
    {
        $pdf = Pdf::loadView($view, $data);
        return $pdf->stream();
    }
}
