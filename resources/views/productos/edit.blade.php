@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" name="precio" class="form-control" value="{{ $producto->precio }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar Producto</button>
    </form>
</div>
@endsection
