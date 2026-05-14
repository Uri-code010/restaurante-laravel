@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center my-4">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
        <div class="row g-0">

            <div class="col-md-6 d-none d-md-block" style="background-image: url('https://static.vecteezy.com/system/resources/previews/026/428/607/non_2x/photography-of-outdoor-cafe-in-daylight-with-smooth-lighting-ai-generated-free-photo.jpg'); background-size: cover; background-position: center; min-height: 600px;">
            </div>

            <div class="col-md-6 p-4 p-lg-5 d-flex flex-column justify-content-center">
                <h2 class="fw-bold text-center mb-2" style="color: var(--dark-color);">Registro de Usuario</h2>
                <p class="text-muted text-center mb-4">Crea tu cuenta para comenzar</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold text-muted small">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="Tu nombre completo" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold text-muted small">Correo</label>
                        <input type="email" name="email" id="email" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="ejemplo@correo.com" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label fw-bold text-muted small">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="********" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label fw-bold text-muted small">Confirmar</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="********" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="form-label fw-bold text-muted small">Rol en el sistema</label>
                        <select name="role" id="role" class="form-select bg-light border-0 shadow-none rounded-3 fw-bold text-secondary" required>
                            <option value="cliente">Soy Cliente</option>
                            <option value="cocinero">Soy Cocinero</option>
                        </select>
                    </div>

                    <button type="submit" class="btn w-100 text-white rounded-3 fw-bold shadow-sm mb-3" style="background-color: var(--dark-color);">
                        Registrarse
                    </button>
                </form>

                <p class="text-center text-muted small mt-2">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: var(--accent-color);">Inicia sesión aquí</a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
