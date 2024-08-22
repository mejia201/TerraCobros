@extends('layouts/dashboard')
@section('title', 'Editar Propiedad')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Editar información de la propiedad</h5>
        <div class="card-body">
            <form action="{{ route('propiedad.update', $propiedad->id_propiedad) }}" method="post" class="row needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group col-md-4">
                    <label for="area_terreno">Área del Terreno: </label>
                    <input type="text" class="form-control {{ $errors->has('area_terreno') ? 'is-invalid' : '' }}"
                        name="area_terreno" id="area_terreno" value="{{ number_format($propiedad->areaTerreno, 2, '.', ',') }}"  required>
                    @if ($errors->has('area_terreno'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area_terreno') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="precio_vrs">Precio por VRS²: </label>
                    <input type="text" class="form-control {{ $errors->has('precio_vrs') ? 'is-invalid' : '' }}"
                        name="precio_vrs" id="precio_vrs" value="{{ number_format($propiedad->precioPorVRS, 2, '.', ',') }}" required>
                    @if ($errors->has('precio_vrs'))
                        <div class="invalid-feedback">
                            {{ $errors->first('precio_vrs') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="precio_total">Precio Total: </label>
                    <input type="text" class="form-control {{ $errors->has('precio_total') ? 'is-invalid' : '' }}"
                        name="precio_total" id="precio_total" value="{{ number_format($propiedad->precioTotal, 2, '.', ',') }}" readonly>
                    @if ($errors->has('precio_total'))
                        <div class="invalid-feedback">
                            {{ $errors->first('precio_total') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 mt-2">
                    <label for="prima_efectivo">Prima en Efectivo: </label>
                    <input type="text" class="form-control {{ $errors->has('prima_efectivo') ? 'is-invalid' : '' }}"
                        name="prima_efectivo" id="prima_efectivo" value="{{ number_format($propiedad->primaEnEfectivo, 2, '.', ',') }}" readonly>
                    @if ($errors->has('prima_efectivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('prima_efectivo') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 mt-2">
                    <label for="monto_financiar">Monto a Financiar: </label>
                    <input type="text" class="form-control {{ $errors->has('monto_financiar') ? 'is-invalid' : '' }}"
                        name="monto_financiar" id="monto_financiar" value="{{ number_format($propiedad->montoAFinanciar, 2, '.', ',') }}" readonly>
                    @if ($errors->has('monto_financiar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('monto_financiar') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 mt-2">
                    <label for="ingreso_requerido">Ingreso Requerido: </label>
                    <input type="text" class="form-control {{ $errors->has('ingreso_requerido') ? 'is-invalid' : '' }}"
                        name="ingreso_requerido" id="ingreso_requerido" value="{{ number_format($propiedad->ingresoRequerido, 2, '.', ',') }}" readonly>
                    @if ($errors->has('ingreso_requerido'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ingreso_requerido') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 mt-2">
                    <label for="estado">Estado: </label>
                    <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado" required>
                        <option value="D" {{ $propiedad->estado == 'D' ? 'selected' : '' }}>Disponible</option>
                        <option value="R" {{ $propiedad->estado == 'R' ? 'selected' : '' }}>Reservado</option>
                    </select>
                    @if ($errors->has('estado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-12 mt-3 text-end">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                    <a href="{{ route('propiedad.index') }}" class="btn btn-dark">Regresar</a>
                </div>
            </form>
        </div>
    </div>

@endsection

