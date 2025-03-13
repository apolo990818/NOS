<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Reporte_nombre_precio;
use App\Exports\SalientesExport;
use App\Exports\ConsolidadoExport;

class ReporteController extends Controller
{
    /**
     * Muestra el formulario para seleccionar el reporte a descargar.
     */
    public function selectReport()
    {
        return view('reportes.select_single');
    }

    /**
     * Procesa la selección y genera la descarga del Excel.
     */
    public function exportSingle(Request $request)
{
    $reportType = $request->input('report_type');
    // Captura las fechas enviadas desde el formulario
    $fechaDesde = $request->input('fecha_desde');
    $fechaHasta = $request->input('fecha_hasta');

    switch ($reportType) {
        case 'Reporte_nombre_precio':
            // Instancia el exportador de Entrantes, pasando los filtros de fecha
            $export = new Reporte_nombre_precio($fechaDesde, $fechaHasta);
            $fileName = 'reporte_entrantes.xlsx';
            break;
        case 'salientes':
            // Supongamos que también quieres filtrar por fecha en este exportador:
            $export = new SalientesExport($fechaDesde, $fechaHasta);
            $fileName = 'reporte_salientes.xlsx';
            break;
        case 'consolidado':
            // Si el consolidado no utiliza el filtro, simplemente:
            $export = new ConsolidadoExport();
            $fileName = 'reporte_consolidado.xlsx';
            break;
        default:
            return redirect()->back()->withErrors(['report_type' => 'Selecciona un reporte válido.']);
    }

    return Excel::download($export, $fileName);
}

}
