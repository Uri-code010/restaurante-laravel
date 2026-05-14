@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4 bg-white p-4 rounded-4 shadow-sm" style="border-left: 5px solid var(--dark-color) !important;">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark-color);">Panel de Cocina</h4>
                <p class="text-muted mb-0">Gestiona las órdenes entrantes en tiempo real.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <button onclick="window.location.reload();" class="btn btn-lg text-white rounded-pill shadow-sm fw-bold px-4" style="background-color: var(--accent-color);">
                    Actualizar Pedidos
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($ordenes as $orden)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" style="background-color: #fffdf7; border-top: 8px solid var(--dark-color) !important;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 class="fw-bold mb-0" style="color: var(--accent-color);">#{{ $orden->id }}</h4>
                                <small class="text-muted">{{ $orden->created_at->format('h:i A') }}</small>
                            </div>

                            @php
                                $statusClass = [
                                    'pendiente' => 'bg-danger',
                                    'en_preparacion' => 'bg-warning text-dark',
                                    'lista' => 'bg-success'
                                ][$orden->estado];
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-2">
                                {{ strtoupper(str_replace('_', ' ', $orden->estado)) }}
                            </span>
                        </div>

                        <p class="mb-3"><strong>Cliente:</strong> {{ $orden->usuario->name }}</p>

                        <div class="rounded-3 p-3 mb-3" style="background-color: #f8f9fa; border: 1px dashed #ccc;">
                            <ul class="list-unstyled mb-0">
                                @foreach($orden->detalles as $detalle)
                                    <li class="d-flex justify-content-between mb-2">
                                        <span><strong class="text-dark">{{ $detalle->cantidad }}x</strong> {{ $detalle->platillo->nombre }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <h5 class="fw-bold m-0">${{ number_format($orden->total, 2) }}</h5>

                            <form action="{{ route('orden.estado', $orden->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm rounded-pill px-4 fw-bold text-white" style="background-color: var(--dark-color);">
                                    {{ $orden->estado === 'pendiente' ? 'Empezar' : ($orden->estado === 'en_preparacion' ? 'Terminar' : 'Cerrar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No hay pedidos pendientes ☕</h3>
            </div>
        @endforelse
    </div>
</div>
@endsection
