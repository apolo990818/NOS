@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seleccionar Reporte a Descargar</h1>

    <form action="{{ route('reportes.exportSingle') }}" method="GET">
        <div class="mb-3">
            <label for="report_type" class="form-label">Elige el reporte:</label>
            <select name="report_type" id="report_type" class="form-select">
                <option value="">-- Selecciona --</option>
                <option value="Reporte_nombre_precio">Reporte de Nombre Precio</option>
                <option value="ProductosResumenExport">Reporte de Resumen Total</option>
                <option value="consolidado">Reporte Consolidado</option>
                <option value="usuarios">Reporte usuarios</option>
                <option value="ProductosEliminados">Reporte Productos Eliminados</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_desde" class="form-label">Fecha Desde:</label>
            <input type="date" name="fecha_desde" id="fecha_desde" class="form-control">
        </div>
        <div class="mb-3">
            <label for="fecha_hasta" class="form-label">Fecha Hasta:</label>
            <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Descargar Excel</button>
    </form>
    
</div>
@endsection
