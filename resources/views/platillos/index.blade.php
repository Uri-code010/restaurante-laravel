<!DOCTYPE html>
<html>
<head>
    <title>Platillos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h1 class="text-center mb-4">🍽️ Gestión de Platillos</h1>

<a href="/platillos/crear" class="btn btn-success mb-3">+ Agregar Platillo</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="color: red; font-weight: bold;">
        {{ session('error') }}
    </div>
@endif

<form method="GET" action="{{ route('platillos.index') }}">

    <input type="text" name="buscar" placeholder="Buscar platillo..." value="{{ $buscar }}">

    <select name="categoria">
        <option value="">Todas las categorías</option>

        @foreach($categorias as $cat)
            <option value="{{ $cat }}" {{ $categoria == $cat ? 'selected' : '' }}>
                {{ $cat }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filtrar</button>

</form>
<br>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($platillos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nombre }}</td>
            <td>${{ $p->precio }}</td>
            <td>{{ $p->categoria }}</td>
            <td>
                <a href="/platillos/{{ $p->id }}/editar" class="btn btn-warning btn-sm">Editar</a>

                <form action="/platillos/{{ $p->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

{{ $platillos->links() }}

</body>
</html>