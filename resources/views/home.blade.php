@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido al Home</h1>
    
    <div class="mt-4">
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Crear Producto</a>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Ver Productos</a>
        <a href="{{ route('reportes.selectSingle') }}" class="btn btn-info">Ver Reportes</a>
    </div>
</div>
@endsection


<!--
<link rel="stylesheet" href="{{ asset('css/chat.css') }}?v={{ time() }}">
<script src="{{ asset('js/chat.js') }}?v={{ time() }}"></script>
-->
