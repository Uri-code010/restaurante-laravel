@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="fw-bold mb-4" style="color: var(--dark-color);">Tu Pedido</h4>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        @if(count($pedido) > 0)
            <table class="table table-borderless align-middle">
                <thead class="border-bottom">
                    <tr class="text-muted">
                        <th>Platillo</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedido as $id => $item)
                        <tr>
                            <td class="fw-bold">{{ $item['nombre'] }}</td>
                            <td class="text-center">{{ $item['cantidad'] }}</td>
                            <td class="text-end">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-top">
                    <tr>
                        <td colspan="2" class="text-end fw-bold fs-5 pt-4">Total a pagar:</td>
                        <td class="text-end fw-bold fs-4 pt-4" style="color: var(--accent-color);">${{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-end mt-4">
                <a href="/menu" class="btn btn-light rounded-pill px-4 me-2">Seguir ordenando</a>
                <a href="{{ route('pedido.ticket') }}" class="btn text-white rounded-pill px-5 fw-bold" style="background-color: var(--dark-color);">
                    Generar Ticket y Finalizar ✅
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <h4 class="text-muted">Aún no has agregado nada a tu pedido</h4>
                <a href="/menu" class="btn mt-3 text-white rounded-pill px-4" style="background-color: var(--accent-color);">Ir al Menú</a>
            </div>
        @endif
    </div>
</div>
@endsection
