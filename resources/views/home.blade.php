@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido  {{ Auth::user()->name }}</h1>
</div>
@endsection


<!--
<link rel="stylesheet" href="{{ asset('css/chat.css') }}?v={{ time() }}">
<script src="{{ asset('js/chat.js') }}?v={{ time() }}"></script>
-->
