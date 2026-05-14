<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee Dreams</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold fs-1 d-flex align-items-center gap-2" href="/menu" style="color: var(--accent-color);">
                <span class="fs-3"></span> Coffee Dreams
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-muted" href="{{ route('login') }}">Ingresar</a>
                        </li>
                    @else
                        @if(auth()->user()->role === 'cliente')
                            <li class="nav-item">
                                <a class="nav-link fw-bold px-3 {{ request()->is('menu*') ? 'text-dark' : 'text-muted' }}" href="/menu">Ver Menú</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold px-3 {{ request()->is('mis-ordenes*') ? 'text-dark' : 'text-muted' }}" href="{{ route('orden.mis') }}">Mis Pedidos</a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'cocinero')
                            <li class="nav-item ms-lg-3">
                                <a class="nav-link fw-bold px-3 {{ request()->is('ordenes*') ? 'active' : '' }}" href="{{ route('orden.index') }}" style="color: var(--dark-color);">
                                    Cocina
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold px-3 {{ request()->is('platillos*') ? 'active' : '' }}" href="{{ route('platillos.index') }}" style="color: var(--dark-color);">
                                    Inventario
                                </a>
                            </li>
                        @endif

                        <li class="nav-item ms-lg-4 d-flex align-items-center border-start ps-3">
                            <span class="text-muted small me-3">👤 {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 fw-bold small">Salir</button>
                            </form>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
