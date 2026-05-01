<!DOCTYPE html>
<html>
<head>
    <title>Editar Platillo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h1>Editar Platillo</h1>

<form action="/platillos/{{ $platillo->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ $platillo->nombre }}">
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input type="number" name="precio" class="form-control" value="{{ $platillo->precio }}">
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <input type="text" name="categoria" class="form-control" value="{{ $platillo->categoria }}">
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="/platillos" class="btn btn-secondary">Volver</a>
</form>

</body>
</html>