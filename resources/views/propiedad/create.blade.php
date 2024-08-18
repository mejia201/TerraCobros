@extends('layouts/dashboard')
@section('title', 'Ingresar Propiedades')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Propiedades</h5>
    <div class="card-body">
        <form action="{{ route('propiedad.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf

            <div class="form-group col-md-6">
                <label for="area_terreno">Área del Terreno (VRS²):</label>
                <input type="text" class="form-control @error('area_terreno') is-invalid @enderror" name="area_terreno" id="area_terreno" value="{{ old('area_terreno') }}" required>
                @error('area_terreno')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="precio_vrs">Precio por VRS²:</label>
                <input type="text" class="form-control @error('precio_vrs') is-invalid @enderror" name="precio_vrs" id="precio_vrs" value="{{ old('precio_vrs') }}" required>
                @error('precio_vrs')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="precio_total">Precio Total:</label>
                <input type="text" class="form-control @error('precio_total') is-invalid @enderror" name="precio_total" id="precio_total" value="{{ old('precio_total') }}" required>
                @error('precio_total')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="prima_efectivo">Prima en Efectivo:</label>
                <input type="text" class="form-control @error('prima_efectivo') is-invalid @enderror" name="prima_efectivo" id="prima_efectivo" value="{{ old('prima_efectivo') }}" required>
                @error('prima_efectivo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="monto_financiar">Monto a Financiar:</label>
                <input type="text" class="form-control @error('monto_financiar') is-invalid @enderror" name="monto_financiar" id="monto_financiar" value="{{ old('monto_financiar') }}" required>
                @error('monto_financiar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="ingreso_requerido">Ingreso Requerido:</label>
                <input type="text" class="form-control @error('ingreso_requerido') is-invalid @enderror" name="ingreso_requerido" id="ingreso_requerido" value="{{ old('ingreso_requerido') }}" required>
                @error('ingreso_requerido')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


    
            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <a href="{{ route('propiedad.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('AfterScript')


@endsection

