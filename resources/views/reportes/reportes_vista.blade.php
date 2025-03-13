@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte Detallado de Productos</h1>

    <!-- Resumen del reporte -->
    <div class="card mb-3">
        <div class="card-header">Resumen</div>
        <div class="card-body">
            <p><strong>Total de Productos:</strong> {{ $totalProductos }}</p>
            <p><strong>Total de Stock:</strong> {{ $totalStock }}</p>
            <p><strong>Valor de Inventario:</strong> ${{ number_format($totalValorInventario, 2) }}</p>
        </div>
    </div>

    <!-- Botón para descargar el Excel -->
    <a href="{{ route('reportes.export') }}" class="btn btn-success mb-3">Descargar Excel</a>

    <!-- Listado detallado de productos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->stock }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No hay productos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
