@extends('layouts/dashboard')
@section('title', 'Editar Financiamiento')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Editar información del financiamiento</h5>
        <div class="card-body">
            <form action="{{ route('financiamiento.update', $financiamiento->id_financiamiento) }}" method="post" class="row needs-validation" novalidate>
                @csrf
                @method('PUT')

                 <!-- Cliente -->
                 <div class="form-group col-md-4">
                    <label for="id_cliente">Cliente:</label>
                    <select class="form-control {{ $errors->has('id_cliente') ? 'is-invalid' : '' }}" name="id_cliente" id="id_cliente" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $financiamiento->id_cliente ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_cliente'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_cliente') }}
                        </div>
                    @endif
                </div>

                <!-- Propiedad -->
                <div class="form-group col-md-4">
                    <label for="id_propiedad">Propiedad:</label>
                    <select class="form-control {{ $errors->has('id_propiedad') ? 'is-invalid' : '' }}" name="id_propiedad" id="id_propiedad" required>
                        @foreach($propiedades as $propiedad)
                            <option value="{{ $propiedad->id_propiedad }}" {{ $propiedad->id_propiedad == $financiamiento->id_propiedad ? 'selected' : '' }}>
                                Lote: {{ $propiedad->id_propiedad }} - Área: {{ number_format($propiedad->areaTerreno, 2, '.', ',') }} VRS²
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_propiedad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_propiedad') }}
                        </div>
                    @endif
                </div>

                     {{-- Modal para agregar financiamiento --}}
            <div class="modal fade" id="modalOpcionesFinanciamiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalOpcionesFinanciamientoLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalOpcionesFinanciamientoLabel">Opciones de Financiamiento</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <ul id="opcionesFinanciamientoList" class="list-group"></ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>



                <div class="form-group col-md-4">
                    <label for="tasaInteres">Tasa de Interés (%):</label>
                    <input type="number" step="0.01" class="form-control" name="tasaInteres" id="tasaInteres" value="{{$financiamiento->tasaInteres}}" required>
                </div>
    
                <div class="form-group col-md-6 mt-3">
                    <label for="plazoAnos">Plazo (años):</label>
                    <input type="number" class="form-control" name="plazoAnos" id="plazoAnos" value="{{$financiamiento->plazoAnos}}" required>
                </div>
    
                <div class="form-group col-md-6 mt-3">
                    <label for="pagoMensual">Pago Mensual:</label>
                    <input type="number" step="0.01" class="form-control" name="pagoMensual" id="pagoMensual" value="{{ number_format($financiamiento->pagoMensual, 2, '.', ',') }}" required>
                </div>
    
                <div class="form-group col-md-6 mt-3">
                    <label for="numeroCuotas">Número de Cuotas:</label>
                    <input type="number" class="form-control" name="numeroCuotas" id="numeroCuotas" value="{{$financiamiento->numeroCuotas}}" required>
                </div>
    
                <!-- Fecha de inicio -->
                <div class="form-group col-md-6 mt-3">
                    <label for="fechaInicio">Fecha de Inicio:</label>
                    <input type="date" class="form-control @error('fechaInicio') is-invalid @enderror" name="fechaInicio" id="fechaInicio" value="{{$financiamiento->fechaInicio}}" required>
                    @error('fechaInicio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    

                <div class="form-group col-md-12 mt-3 text-end">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                    <a href="{{ route('financiamiento.index') }}" class="btn btn-dark">Regresar</a>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('AfterScript')


<script>
    $(document).ready(function() {
        $('#id_propiedad').on('change', function() {
            var id_propiedad = $(this).val();
            if (id_propiedad) {
                $.ajax({
                    url: "{{ route('financiamiento.obtenerOpciones') }}",
                    type: "GET",
                    data: { id_propiedad: id_propiedad },
                    success: function(opciones) {
                        $('#opcionesFinanciamientoList').empty();
                        opciones.forEach(function(opcion, index) {
                            $('#opcionesFinanciamientoList').append(
                                `<li class="list-group-item">
                                    Plazo: ${opcion.plazoAnos} años, Pago Mensual: $${opcion.pagoMensual}, Cuotas: ${opcion.numeroCuotas} 
                                    <button type="button" class="btn btn-primary btn-sm float-right seleccionar-opcion ms-2" data-opcion='${JSON.stringify(opcion)}'>Seleccionar</button>
                                </li>`
                            );
                        });
                        $('#modalOpcionesFinanciamiento').modal('show');
                    }
                });
            }
        });
    
        $(document).on('click', '.seleccionar-opcion', function() {
            var opcion = $(this).data('opcion');
            $('#tasaInteres').val(opcion.tasaInteres);
            $('#plazoAnos').val(opcion.plazoAnos);
            $('#pagoMensual').val(opcion.pagoMensual);
            $('#numeroCuotas').val(opcion.numeroCuotas);
            $('#modalOpcionesFinanciamiento').modal('hide');
        });
    });
    </script>

@endsection