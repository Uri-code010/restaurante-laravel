<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema del Restaurante</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tus estilos personalizados con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- Barra de Navegación Estilo Café Moderno -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 mb-4">
        <div class="container">
            <!-- Logo/Nombre del Restaurante -->
            <a class="navbar-brand fw-bold fs-2 d-flex align-items-center gap-2" href="/menu" style="color: var(--accent-color);">
                <span class="fs-3"></span> Coffee Dreams
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-bold px-3 text-dark" href="/menu">Ver Menú</a>
                    </li>

                    <!-- Botones de los administradores (Tus compañeros) -->
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-sm rounded-pill px-4 text-white" href="/platillos" style="background-color: var(--dark-color);">
                            ⚙️ Panel Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor Principal (Aquí entrarán las otras vistas) -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
