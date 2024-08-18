@extends('layouts/dashboard')
@section('title', 'Ingresar financiamiento')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Financiamiento</h5>
    <div class="card-body">
        <form action="{{ route('financiamiento.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf


              <!-- Cliente -->
              <div class="form-group col-md-6">
                <label for="id_cliente">Cliente:</label>
                <select class="form-control @error('id_cliente') is-invalid @enderror" name="id_cliente" id="id_cliente" required>
                    <option value="" disabled selected>Seleccionar Cliente</option>
                
                    @foreach($clientes as $id_cliente => $nombre )
                        <option value="{{ $id_cliente }}">{{ $nombre }}</option>
                    @endforeach

                
                </select>
                @error('id_cliente')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Propiedad -->
            <div class="form-group col-md-6">
                <label for="id_propiedad">Propiedad:</label>
                <select class="form-control @error('id_propiedad') is-invalid @enderror" name="id_propiedad" id="id_propiedad" required>
                    <option value="" disabled selected>Seleccionar Propiedad</option>
          
                    @foreach($propiedades as $id_propiedad => $areaTerreno )
                        <option value="{{ $id_propiedad }}">{{ $areaTerreno }}</option>
                    @endforeach
                </select>
                @error('id_propiedad')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tasa de interés -->
            <div class="form-group col-md-6 mt-3">
                <label for="tasa_interes">Tasa de Interés (%):</label>
                <input type="number" step="0.01" class="form-control @error('tasa_interes') is-invalid @enderror" name="tasa_interes" id="tasa_interes" value="{{ old('tasa_interes') }}" required>
                @error('tasa_interes')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Plazo en años -->
            <div class="form-group col-md-6 mt-3">
                <label for="plazo_anios">Plazo (años):</label>
                <input type="number" class="form-control @error('plazo_anios') is-invalid @enderror" name="plazo_anios" id="plazo_anios" value="{{ old('plazo_anios') }}" required>
                @error('plazo_anios')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Pago mensual -->
            <div class="form-group col-md-6 mt-3">
                <label for="pago_mensual">Pago Mensual:</label>
                <input type="number" step="0.01" class="form-control @error('pago_mensual') is-invalid @enderror" name="pago_mensual" id="pago_mensual" value="{{ old('pago_mensual') }}" required>
                @error('pago_mensual')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Número de cuotas -->
            <div class="form-group col-md-6 mt-3">
                <label for="numero_cuotas">Número de Cuotas:</label>
                <input type="number" class="form-control @error('numero_cuotas') is-invalid @enderror" name="numero_cuotas" id="numero_cuotas" value="{{ old('numero_cuotas') }}" required>
                @error('numero_cuotas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Fecha de inicio -->
            <div class="form-group col-md-6 mt-3">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        

            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <a href="{{ route('financiamiento.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('AfterScript')


@endsection

