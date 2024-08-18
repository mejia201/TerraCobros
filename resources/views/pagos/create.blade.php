@extends('layouts/dashboard')
@section('title', 'Ingresar Pagos')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Pagos</h5>
    <div class="card-body">
        <form action="{{ route('pago.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf


            <div class="form-group col-md-6">
                <label for="id_financiamiento">Financiamiento:</label>
                <select class="form-control @error('id_financiamiento') is-invalid @enderror" name="id_financiamiento" id="id_financiamiento" required>
                    <option value="" disabled selected>Seleccione un financiamiento</option>
                    @foreach($financiamientos as $id_financiamiento => $descripcion)
                        <option value="{{ $id_financiamiento }}">{{ $descripcion }}</option>
                    @endforeach
                </select>
                @error('id_financiamiento')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="fecha_pago">Fecha del Pago:</label>
                <input type="date" class="form-control @error('fecha_pago') is-invalid @enderror" name="fecha_pago" id="fecha_pago" value="{{ old('fecha_pago') }}" required>
                @error('fecha_pago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="monto_pago">Monto del Pago:</label>
                <input type="text" class="form-control @error('monto_pago') is-invalid @enderror" name="monto_pago" id="monto_pago" value="{{ old('monto_pago') }}" required>
                @error('monto_pago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="fecha_pago_esperada">Fecha de Pago Esperada:</label>
                <input type="date" class="form-control @error('fecha_pago_esperada') is-invalid @enderror" name="fecha_pago_esperada" id="fecha_pago_esperada" value="{{ old('fecha_pago_esperada') }}" required>
                @error('fecha_pago_esperada')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
       


    
            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <a href="{{ route('pago.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('AfterScript')


@endsection

