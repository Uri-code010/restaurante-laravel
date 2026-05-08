@extends('layouts.app')

@section('content')
<h1>Mis Órdenes</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Total</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ordenes as $orden)
        <tr>
            <td>{{ $orden->id }}</td>
            <td>{{ $orden->estado }}</td>
            <td>${{ $orden->total }}</td>
            <td>
                <ul>
                    @foreach($orden->detalles as $detalle)
                        <li>{{ $detalle->platillo->nombre }} x {{ $detalle->cantidad }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
