@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Editar Producto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('productos.update', $producto) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del Producto *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="categoria" class="form-label">Categoría *</label>
                            <select class="form-select @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                                @foreach($categorias as $key => $label)
                                    <option value="{{ $key }}" {{ old('categoria', $producto->categoria) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="version" class="form-label">Versión *</label>
                            <input type="text" class="form-control @error('version') is-invalid @enderror" id="version" name="version" value="{{ old('version', $producto->version) }}" required>
                            @error('version')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_lanzamiento" class="form-label">Fecha de Lanzamiento *</label>
                            <input type="date" class="form-control @error('fecha_lanzamiento') is-invalid @enderror" id="fecha_lanzamiento" name="fecha_lanzamiento" value="{{ old('fecha_lanzamiento', $producto->fecha_lanzamiento->format('Y-m-d')) }}" required>
                            @error('fecha_lanzamiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="precio_compra" class="form-label">Precio de Compra (COP) *</label>
                            <input type="number" class="form-control @error('precio_compra') is-invalid @enderror" id="precio_compra" name="precio_compra" value="{{ old('precio_compra', $producto->precio_compra) }}" min="0" required>
                            @error('precio_compra')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="precio_alquiler_mensual" class="form-label">Precio Alquiler Mensual (COP) *</label>
                            <input type="number" class="form-control @error('precio_alquiler_mensual') is-invalid @enderror" id="precio_alquiler_mensual" name="precio_alquiler_mensual" value="{{ old('precio_alquiler_mensual', $producto->precio_alquiler_mensual) }}" min="0" required>
                            @error('precio_alquiler_mensual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="precio_alquiler_anual" class="form-label">Precio Alquiler Anual (COP) *</label>
                            <input type="number" class="form-control @error('precio_alquiler_anual') is-invalid @enderror" id="precio_alquiler_anual" name="precio_alquiler_anual" value="{{ old('precio_alquiler_anual', $producto->precio_alquiler_anual) }}" min="0" required>
                            @error('precio_alquiler_anual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="requisitos_sistema" class="form-label">Requisitos del Sistema</label>
                            <textarea class="form-control" id="requisitos_sistema" name="requisitos_sistema" rows="2">{{ old('requisitos_sistema', $producto->requisitos_sistema) }}</textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" {{ old('activo', $producto->activo) ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">Producto activo</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
