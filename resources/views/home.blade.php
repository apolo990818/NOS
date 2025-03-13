@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido  {{ Auth::user()->name }}</h1>
    
    <div class="mt-4">
        <a href="{{ route('productos.create') }}" class="btn btn-success">Crear Producto</a>
        <a href="{{ route('productos.index') }}" class="btn btn-primary">Ver Productos</a>
        <a href="{{ route('reportes.selectSingle') }}" class="btn btn-secondary">Ver Reportes</a>
    </div>
</div>
@endsection


<!--
<link rel="stylesheet" href="{{ asset('css/chat.css') }}?v={{ time() }}">
<script src="{{ asset('js/chat.js') }}?v={{ time() }}"></script>
-->
