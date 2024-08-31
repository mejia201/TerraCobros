@extends('layouts/dashboard')
@section('title', 'Editar Pago')
@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Editar Pago</h5>
    <div class="card-body">
        <form action="{{ route('pago.update', $pago->id_pago) }}" method="post" class="row needs-validation" novalidate>
            @csrf
            @method('PUT')

            @foreach($pago->detallePagos as $detallePago)
                <div class="form-group col-md-6">
                    <label for="montoPago">Monto de Pago</label>
                    <input type="number" step="0.01" name="montoPago[]" class="form-control" value="{{ $detallePago->montoPago }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="fechaPago">Fecha de Pago</label>
                    <input type="date" name="fechaPago[]" class="form-control" value="{{ $detallePago->fechaPago }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="montoMora">Monto Mora</label>
                    <input type="number" step="0.01" name="montoMora[]" class="form-control" value="{{ $detallePago->monto_mora }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion[]" class="form-control" value="{{ $detallePago->descripcion }}">
                </div>
            @endforeach

            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Actualizar">
                <a href="{{ route('pago.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection
