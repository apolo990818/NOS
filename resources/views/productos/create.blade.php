@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" name="precio" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-primary">Ver Productos</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Inicio</a>
    </form>
</div>
@endsection
