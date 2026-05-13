@extends('layouts.app')

@section('content')
    <!-- Encabezado de Administración -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4 bg-white p-4 rounded-4 shadow-sm" style="border-left: 5px solid var(--dark-color);">
        <div>
            <h4 class="fw-bold mb-0" style="color: var(--dark-color);">Gestión de Inventario</h4>
            <p class="text-muted mb-0">Control total del menú. Los cambios aquí se reflejarán inmediatamente a los clientes.</p>
        </div>
        <div>
            <a href="{{ route('platillos.create') }}" class="btn btn-lg text-white rounded-pill shadow-sm fw-bold px-4" style="background-color: var(--accent-color);">
                + Añadir Nuevo
            </a>
        </div>
    </div>

    <!-- Mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert" style="background-color: #d4edda; color: #155724;">
            <strong>✨ ¡Listo!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Cuadrícula de Tarjetas ADMIN (Aquí SÍ hay botones de Editar y Eliminar) -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($platillos as $platillo)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">

                    <img src="{{ $platillo->imagen ?? 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500' }}" class="card-img-top" alt="{{ $platillo->nombre }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title fw-bold" style="color: var(--dark-color);">{{ $platillo->nombre }}</h5>
                            <span class="badge rounded-pill bg-light text-dark border">{{ ucfirst($platillo->categoria) }}</span>
                        </div>
                        <p class="card-text text-muted small mt-2">{{ $platillo->descripcion ?? 'Sin descripción disponible.' }}</p>
                        <h4 class="fw-bold mt-3" style="color: var(--accent-color);">${{ number_format($platillo->precio, 2) }}</h4>
                    </div>

                    <!-- BOTONES EXCLUSIVOS DEL ADMINISTRADOR -->
                    <div class="card-footer bg-white border-0 d-flex justify-content-between pb-3">
                        <a href="/platillos/{{ $platillo->id }}/editar" class="btn btn-sm rounded-pill px-3" style="border: 1px solid var(--dark-color); color: var(--dark-color);">
                            ✏️ Editar
                        </a>

                        <form action="/platillos/{{ $platillo->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm rounded-pill px-3 text-white" style="background-color: var(--dark-color);" onclick="return confirm('¿Seguro que quieres eliminar este platillo?')">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="display-1">☕</div>
                <h4 class="text-muted mt-3">Parece que el inventario está vacío.</h4>
                <p>Usa el botón de arriba para añadir tu primer platillo.</p>
            </div>
        @endforelse
    </div>

    <!-- Controles de Paginación -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $platillos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection
