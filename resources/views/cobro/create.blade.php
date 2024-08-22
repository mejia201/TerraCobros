@extends('layouts/dashboard')
@section('title', 'Registrar Pago')

@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Registrar Pago</h5>
    <div class="card-body">
        <form action="{{ route('cobro.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf

            <div class="form-group col-md-6">
                <label for="id_pago">Pago:</label>
                <select class="form-control @error('id_pago') is-invalid @enderror" name="id_pago" id="id_pago" required>
                    <option value="" disabled selected>Seleccione un pago</option>
                    @foreach($pagos as $id_pago => $descripcion)
                        <option value="{{ $id_pago }}">{{ $descripcion }}</option>
                    @endforeach
                </select>
                @error('id_pago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="fechaPago">Fecha del Pago:</label>
                <input type="date" class="form-control @error('fechaPago') is-invalid @enderror" name="fechaPago" id="fechaPago" value="{{ old('fechaPago') }}" required>
                @error('fechaPago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="montoPagado">Monto Pagado:</label>
                <input type="text" class="form-control @error('montoPagado') is-invalid @enderror" name="montoPagado" id="montoPagado" value="{{ old('montoPagado') }}" required>
                @error('montoPagado')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="monto_mora">Mora (Si corresponde):</label>
                <input type="text" class="form-control @error('monto_mora') is-invalid @enderror" name="monto_mora" id="monto_mora" value="{{ old('monto_mora', 0) }}" disabled>
                @error('monto_mora')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-2">
                <label for="monto_total">Monto Total:</label>
                <input type="text" class="form-control @error('monto_total') is-invalid @enderror" name="monto_total" id="monto_total" value="{{ old('monto_total') }}" required>
                @error('monto_total')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <a href="{{ route('cobro.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('AfterScript')
@endsection
