@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Órdenes (Cocina)</h1>

    <table border="1" style="width: 100%; border-collapse: collapse; text-align: center;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenes as $orden)
            <tr>
                <td>#{{ $orden->id }}</td>
                <td>{{ $orden->usuario->name }}</td>
                
                <!-- Columna de Estado con colores (Semáforo) -->
                <td>
                    @if($orden->estado === 'pendiente')
                        <span style="background-color: #ffcccc; color: #cc0000; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                            🔴 PENDIENTE
                        </span>
                    @elseif($orden->estado === 'en_preparacion')
                        <span style="background-color: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                            🟡 EN PREPARACIÓN
                        </span>
                    @else
                        <span style="background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                            🟢 LISTA
                        </span>
                    @endif
                </td>

                <td>${{ number_format($orden->total, 2) }}</td>
                
                <td>
                    <!-- Solo mostramos el botón de acción si NO está lista -->
                    @if($orden->estado !== 'lista')
                        <form action="{{ route('orden.estado', $orden->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="cursor:pointer; padding: 5px;">
                                @if($orden->estado === 'pendiente')
                                    👨‍🍳 Empezar Preparación
                                @else
                                    ✅ Marcar como Lista
                                @endif
                            </button>
                        </form>
                    @else
                        <span style="color: green; font-weight: bold;">Completada</span>
                    @endif

                    <!-- Botón para ver el detalle de la orden -->
                    <a href="{{ route('orden.show', $orden->id) }}" style="margin-left: 10px;">Ver Detalle</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection