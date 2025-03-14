@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    
    <!-- Importante: agregar enctype para subir archivos -->
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
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
        <!-- Campo para subir la imagen -->
        <div class="mb-3">
            <label for="image" class="form-label">Imagen del producto:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Guardar Producto</button>
    </form>
</div>
@endsection
