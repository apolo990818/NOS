@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="login-container">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <h3 class="mb-4 text-center fw-bold text-primary">Bienvenido</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>Correo electrónico
                    </label>
                    <input type="email" name="email" id="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus placeholder="tu@correo.com">
                    @error('email')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>Contraseña
                    </label>
                    <input type="password" name="password" id="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        required placeholder="••••••••">
                    @error('password')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
