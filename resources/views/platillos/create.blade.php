@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-7">

        <div class="card shadow border-0 rounded-4" style="background-color: var(--card-bg);">
            <div class="card-body p-6">
                <h4 class="fw-bold mb-4" style="color: var(--dark-color);">Agrega al menú</h4>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('platillos.store') }}" method="POST">
                    @csrf <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Nombre del Platillo</label>
                            <input type="text" name="nombre" class="form-control custom-input rounded-pill px-4" value="{{ old('nombre') }}" placeholder="Ej. Frappé de Caramelo" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" class="form-control custom-input rounded-pill px-4" value="{{ old('precio') }}" placeholder="0.00" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Categoría</label>
                            <select name="categoria" class="form-select custom-select rounded-pill px-2" required>
                                <option value="">Selecciona...</option>
                                <option value="clasicos" {{ old('categoria') == 'clasicos' ? 'selected' : '' }}>Clásicos</option>
                                <option value="chill" {{ old('categoria') == 'chill' ? 'selected' : '' }}>Vibras Chill</option>
                                <option value="filtrados" {{ old('categoria') == 'filtrados' ? 'selected' : '' }}>Slow & Flow</option>
                                <option value="postres" {{ old('categoria') == 'postres' ? 'selected' : '' }}>Final Feliz</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">URL de la Imagen</label>
                            <input type="url" name="imagen" class="form-control custom-input rounded-pill px-4" value="{{ old('imagen') }}" placeholder="https://images.unsplash.com/foto-ejemplo">
                            <div class="form-text ms-2">Pega el enlace directo a una imagen de internet.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold" style="color: var(--dark-color);">Descripción</label>
                            <textarea name="descripcion" class="form-control custom-input rounded-4 p-3" rows="3" placeholder="Describe los ingredientes o el sabor de este platillo...">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-3 mt-4">
                            <a href="/platillos" class="btn btn-lg rounded-pill px-3 fw-bold" style="border: 2px solid var(--dark-color); color: var(--dark-color);">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-lg rounded-pill px-3 fw-bold text-white shadow-sm" style="background-color: var(--accent-color);">
                                Guardar
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
