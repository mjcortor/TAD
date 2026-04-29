@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-primary p-5 text-center text-white">
                    <h2 class="fw-bold mb-0">Bienvenido de nuevo</h2>
                    <p class="opacity-75 small mt-2">Accede a tu cuenta de Reposa+</p>
                </div>
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-muted">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-lg border-light bg-light rounded-3" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label small fw-bold text-muted">Contraseña</label>
                                <a href="{{ route('password.request') }}" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
                            </div>
                            <input type="password" class="form-control form-control-lg border-light bg-light rounded-3" id="password" name="password" required>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label small text-muted" for="remember">Recordarme en este equipo</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold rounded-3">
                            Entrar a mi cuenta
                        </button>
                    </form>

                    <div class="text-center mt-5">
                        <p class="text-muted small">¿Aún no tienes cuenta? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Regístrate ahora</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
