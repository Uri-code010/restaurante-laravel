@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
        <div class="row g-0">

            <div class="col-md-6 d-none d-md-block" style="background-image: url('https://i.pinimg.com/originals/6c/02/55/6c0255bc2a83b5146ee5d6b22f15f1ba.jpg'); background-size: cover; background-position: center; min-height: 500px;">
            </div>

            <div class="col-md-6 p-4 p-lg-5 d-flex flex-column justify-content-center">
                <h2 class="fw-bold text-center mb-2" style="color: var(--accent-color);">Bienvenido a Coffee Dreams</h2>
                <p class="text-muted text-center mb-4">Inicia sesión para continuar</p>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 small py-2">Datos incorrectos. Intenta de nuevo.</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold text-muted small">Correo</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg bg-light border-0 shadow-none rounded-3" placeholder="ejemplo@correo.com" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold text-muted small">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg bg-light border-0 shadow-none rounded-3" placeholder="********" required>
                    </div>

                    <button type="submit" class="btn btn-lg w-100 text-white rounded-3 fw-bold shadow-sm mb-3" style="background-color: var(--accent-color);">
                        Ingresar
                    </button>
                </form>

                <p class="text-center text-muted small mt-2">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--dark-color);">Regístrate aquí</a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
