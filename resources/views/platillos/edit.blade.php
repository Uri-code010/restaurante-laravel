@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-10">

        <div class="card shadow border-0 rounded-4" style="background-color: var(--card-bg);">
            <div class="card-body p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold m-0" style="color: var(--dark-color);">✏️ Editar Platillo</h2>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Modo Administrador</span>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario apuntando a la ruta de UPDATE -->
                <form action="{{ route('platillos.update', $platillo->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Directiva clave para actualizar datos -->

                    <div class="row g-4">

                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Nombre del Platillo</label>
                            <input type="text" name="nombre" class="form-control custom-input rounded-pill px-4" value="{{ old('nombre', $platillo->nombre) }}" required>
                        </div>

                        <!-- Precio -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" class="form-control custom-input rounded-pill px-4" value="{{ old('precio', $platillo->precio) }}" required>
                        </div>

                        <!-- Categoría -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Categoría</label>
                            <select name="categoria" class="form-select custom-select rounded-pill px-4" required>
                                <option value="entradas" {{ old('categoria', $platillo->categoria) == 'entradas' ? 'selected' : '' }}>Entradas</option>
                                <option value="platos_fuertes" {{ old('categoria', $platillo->categoria) == 'platos_fuertes' ? 'selected' : '' }}>Platos Fuertes</option>
                                <option value="bebidas" {{ old('categoria', $platillo->categoria) == 'bebidas' ? 'selected' : '' }}>Bebidas</option>
                                <option value="postres" {{ old('categoria', $platillo->categoria) == 'postres' ? 'selected' : '' }}>Postres</option>
                            </select>
                        </div>

                        <!-- Imagen -->
                        <div class="col-12">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">URL de la Imagen</label>
                            <input type="url" name="imagen" class="form-control custom-input rounded-pill px-4" value="{{ old('imagen', $platillo->imagen) }}">

                            <!-- Pequeña vista previa de la imagen actual -->
                            @if($platillo->imagen)
                                <div class="mt-3">
                                    <p class="text-muted small mb-1">Imagen actual:</p>
                                    <img src="{{ $platillo->imagen }}" alt="Vista previa" class="rounded-3 shadow-sm" style="height: 80px; object-fit: cover;">
                                </div>
                            @endif
                        </div>

                        <!-- Descripción -->
                        <div class="col-12">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Descripción</label>
                            <textarea name="descripcion" class="form-control custom-input rounded-4 p-3" rows="3">{{ old('descripcion', $platillo->descripcion) }}</textarea>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="col-12 d-flex justify-content-end gap-3 mt-5">
                            <a href="/platillos" class="btn btn-lg rounded-pill px-4 fw-bold" style="border: 2px solid var(--dark-color); color: var(--dark-color);">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold text-white shadow-sm" style="background-color: var(--accent-color);">
                                Actualizar Platillo
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
