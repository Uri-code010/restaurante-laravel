@extends('layouts.app')

@section('content')
<h1>Detalle de Orden #{{ $orden->id }}</h1>

<p><strong>Cliente:</strong> {{ $orden->usuario->name }}</p>
<p><strong>Estado:</strong> {{ $orden->estado }}</p>
<p><strong>Total:</strong> ${{ $orden->total }}</p>

<h3>Platillos</h3>
<ul>
    @foreach($orden->detalles as $detalle)
        <li>{{ $detalle->platillo->nombre }} - {{ $detalle->cantidad }} x ${{ $detalle->precio_unitario }} = ${{ $detalle->subtotal }}</li>
    @endforeach
</ul>
@endsection
