@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4 mb-4 mt-4 overflow-hidden" style="border-left: 5px solid var(--accent-color) !important;">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--dark-color);">Mis Pedidos</h2>
                <p class="text-muted mb-0">Rastrea tus órdenes y revive tus antojos favoritos.</p>
            </div>
            <div class="d-none d-md-block">
                <a href="/menu" class="btn text-white rounded-pill px-4 fw-bold" style="background-color: var(--dark-color);">
                    + Ordenar algo más
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @forelse ($ordenes as $orden)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4" style="background-color: white;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small fw-bold">ORDEN #{{ $orden->id }}</span>

                            @php
                                $statusStyles = [
                                    'pendiente' => ['bg' => '#ffeded', 'color' => '#dc3545', 'text' => 'Pendiente'],
                                    'en_preparacion' => ['bg' => '#fff9e6', 'color' => '#856404', 'text' => 'En cocina'],
                                    'lista' => ['bg' => '#e6ffed', 'color' => '#28a745', 'text' => '¡Lista!']
                                ][$orden->estado];
                            @endphp

                            <span class="badge rounded-pill px-3 py-2" style="background-color: {{ $statusStyles['bg'] }}; color: {{ $statusStyles['color'] }};">
                                {{ $statusStyles['text'] }}
                            </span>
                        </div>

                        <h5 class="fw-bold mb-1">${{ number_format($orden->total, 2) }}</h5>
                        <p class="text-muted small mb-3">{{ $orden->created_at->format('d M, Y - h:i A') }}</p>

                        <hr class="text-muted opacity-25">

                        <div class="mb-4">
                            @foreach($orden->detalles as $detalle)
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">{{ $detalle->cantidad }}x {{ $detalle->platillo->nombre }}</span>
                                    <span class="fw-bold">${{ number_format($detalle->subtotal, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        @if($orden->estado === 'lista')
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 text-center small fw-bold">
                                ¡Tu orden está lista para recoger!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="display-1 mb-3">☕</div>
                <h4 class="text-muted">Aún no tienes órdenes registradas.</h4>
                <a href="/menu" class="btn mt-3 text-white rounded-pill px-4" style="background-color: var(--accent-color);">Ir al Menú</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
