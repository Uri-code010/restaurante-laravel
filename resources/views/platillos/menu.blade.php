@extends('layouts.app')

@section('content')
    <!-- Encabezado del Cliente -->
    <!-- Encabezado del Cliente (Hero Section) -->
    <div class="bg-white rounded-4 shadow-sm p-5 mb-5 mt-3 position-relative overflow-hidden" style="border-top: 6px solid var(--accent-color);">
        <div class="row align-items-center text-center text-md-start">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-3" style="color: var(--dark-color);">
                    Descubre tu próximo <span style="color: var(--accent-color);">antojo</span>
                </h1>
                <p class="lead text-muted mb-0" style="font-size: 1.1rem;">
                    Granos seleccionados, postres horneados al día y el ambiente perfecto. Tómate un respiro y elige tus favoritos de nuestro menú.
                </p>
            </div>
            <div class="col-md-4 d-none d-md-block text-center">
                <!-- Un adorno visual grande para que no se vea vacío -->
                <span style="font-size: 6rem; opacity: 0.8;">🥐☕</span>
            </div>
        </div>
    </div>

    <!-- Barra de Búsqueda -->
    <div class="card shadow border-0 mb-5 rounded-4" style="background-color: var(--card-bg); border-left: 5px solid var(--accent-color) !important;">
        <div class="card-body p-4">
            <form action="/menu" method="GET" class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0 text-muted rounded-start-pill ps-4">🔍</span>
                        <input type="text" name="buscar" class="form-control border-start-0 custom-input rounded-end-pill" placeholder="¿Qué se te antoja hoy?" value="{{ request('buscar') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="categoria" class="form-select form-select-lg custom-select rounded-pill">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-lg rounded-pill fw-bold text-white custom-btn" style="background-color: var(--dark-color);">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success d-flex justify-content-between align-items-center rounded-4 shadow-sm mb-4">
            <div><strong>¡Añadido!</strong> {{ session('success') }}</div>
            <a href="{{ route('pedido.ver') }}" class="btn btn-success rounded-pill fw-bold">Ver mi pedido 🍽️</a>
        </div>
    @endif

    <!-- Cuadrícula de Tarjetas para Clientes -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($platillos as $platillo)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <img src="{{ $platillo->imagen ?? 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500' }}" class="card-img-top" alt="{{ $platillo->nombre }}" style="height: 220px; object-fit: cover;">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title fw-bold" style="color: var(--dark-color);">{{ $platillo->nombre }}</h5>
                            <span class="badge rounded-pill bg-light text-dark border">{{ ucfirst($platillo->categoria) }}</span>
                        </div>
                        <p class="card-text text-muted small mt-2">{{ $platillo->descripcion ?? 'Sin descripción disponible.' }}</p>
                        <h4 class="fw-bold mt-3" style="color: var(--accent-color);">${{ number_format($platillo->precio, 2) }}</h4>
                    </div>

                    <!-- Sección de Ordenar para el cliente -->
                    <div class="card-footer bg-white border-0 pb-4 pt-0">
                        <form action="{{ route('pedido.agregar', $platillo->id) }}" method="POST">
                            @csrf
                            <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                <input type="number" name="cantidad" value="1" min="1" class="form-control border-0 bg-light text-center" style="max-width: 80px;">
                                <button type="submit" class="btn text-white fw-bold w-100" style="background-color: var(--accent-color);">
                                    + Agregar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted mt-3">Estamos preparando el menú.</h4>
                <p>Vuelve pronto para ver nuestras delicias.</p>
            </div>
        @endforelse
    </div>

    <!-- Controles de Paginación -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $platillos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection
