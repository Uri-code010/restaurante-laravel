<!DOCTYPE html>
<html>
<head>
    <title>Agregar Platillo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h1>Agregar Platillo</h1>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form action="/platillos" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control">
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input type="number" name="precio" class="form-control">
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <input type="text" name="categoria" class="form-control">
    </div>

    <button class="btn btn-primary">Guardar</button>
    <a href="/platillos" class="btn btn-secondary">Volver</a>
</form>

</body>
</html>