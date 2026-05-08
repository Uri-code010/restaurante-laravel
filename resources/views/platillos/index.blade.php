@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🍽️ Nuestro Menú</h2>

    <!-- Buscador -->
    <form action="{{ route('menu') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar platillo...">
            </div>
            <div class="col-md-3">
                <select name="categoria" class="form-control">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ $categoria == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <hr>

    <!-- Formulario para crear la Orden -->
    <form action="{{ route('orden.store') }}" method="POST">
        @csrf 
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Platillo</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th style="width: 150px;">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($platillos as $platillo)
                <tr>
                    <td>{{ $platillo->nombre }}</td>
                    <td>{{ $platillo->categoria }}</td>
                    <td>${{ number_format($platillo->precio, 2) }}</td>
                    <td>
                        <!-- Importante: el name usa el ID del platillo -->
                        <input type="number" name="platillos[{{ $platillo->id }}]" 
                               value="0" min="0" class="form-control">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        {{ $platillos->links() }}

        <div class="mt-4">
            <button type="submit" class="btn btn-success btn-lg">🛒 Confirmar Pedido</button>
        </div>
    </form>
</div>
@endsection