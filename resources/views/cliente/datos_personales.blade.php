@extends('layouts.dashboard')
@section('title', 'Gestionar Cliente')

@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Gestionar Cliente</h5>
    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="datos-personales-tab" data-toggle="tab" href="#datos-personales" role="tab" aria-controls="datos-personales" aria-selected="true">Datos Personales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="referencias-tab" data-toggle="tab" href="#referencias" role="tab" aria-controls="referencias" aria-selected="false">Referencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="info-laboral-tab" data-toggle="tab" href="#info-laboral" role="tab" aria-controls="info-laboral" aria-selected="false">Información Laboral</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="financiamiento-tab" data-toggle="tab" href="#financiamiento" role="tab" aria-controls="financiamiento" aria-selected="false">Financiamiento</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="datos-personales" role="tabpanel" aria-labelledby="datos-personales-tab">
                <!-- Formulario de Datos Personales -->
                @include('cliente.datos_personales')
            </div>

            
        </div>

    </div>
</div>

@endsection




@extends('layouts/dashboard')
@section('title', 'Ingresar clientes')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Cliente</h5>
    <div class="card-body">
        <form action="{{ route('cliente.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf

            <div class="form-group col-md-4">
                <label for="dui">DUI: *</label>
                <input type="text" class="form-control @error('dui') is-invalid @enderror" name="dui" id="dui" required>
                @error('dui')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-8">
                <label for="nombre">Nombre: *</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" required>
                @error('nombre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
                {{-- 1 col --}}
            <div class="form-group col-md-4 mt-2">
                <label for="telefono">Teléfono: *</label>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" required>
                @error('telefono')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="email">Correo electrónico: *</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

                <div class="form-group col-md-4 mt-2">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" id="fecha_nacimiento">
                    @error('fecha_nacimiento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- 2 col --}}
                <div class="form-group col-md-4 mt-2">
                    <label for="edad">Edad:</label>
                    <input type="number" class="form-control @error('edad') is-invalid @enderror" name="edad" id="edad">
                    @error('edad')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    


            <div class="form-group col-md-4 mt-2">
                <label for="sexo">Sexo:</label>
                <select class="form-control @error('sexo') is-invalid @enderror" name="sexo" id="sexo">
                    <option value="">Seleccione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('sexo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group col-md-4 mt-2">
                <label for="estado_civil">Estado Civil:</label>
                <select class="form-control @error('estado_civil') is-invalid @enderror" name="estado_civil" id="estado_civil">
                    <option value="">Seleccione</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Viudo">Viudo</option>
                </select>
                @error('estado_civil')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- 3 col --}}
            <div class="form-group col-md-12 mt-2">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" name="direccion" id="direccion">
            </div>


            {{-- 4 col --}}

            <div class="form-group col-md-4 mt-2">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" class="form-control @error('nacionalidad') is-invalid @enderror" name="nacionalidad" id="nacionalidad">
                @error('nacionalidad')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="pais_nacimiento">País de Nacimiento:</label>
                <input type="text" class="form-control @error('pais_nacimiento') is-invalid @enderror" name="pais_nacimiento" id="pais_nacimiento">
                @error('pais_nacimiento')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="estatus">Estatus:</label>
                <input type="text" class="form-control @error('estatus') is-invalid @enderror" name="estatus" id="estatus">
                @error('estatus')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- 5 col --}}


            <div class="form-group col-md-8 mt-2">
                <label for="medio_enterado">Medio por el que se enteró:</label>
                <input type="text" class="form-control @error('medio_enterado') is-invalid @enderror" name="medio_enterado" id="medio_enterado">
                @error('medio_enterado')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="tipo_cliente">Tipo de Cliente:</label>
                <select class="form-control @error('tipo_cliente') is-invalid @enderror" name="tipo_cliente" id="tipo_cliente">
                    <option value="">Seleccione</option>
                    <option value="Comerciante">Comerciante</option>
                    <option value="Empleado">Empleado</option>
                    <option value="Extranjero">Extranjero</option>
                    <option value="Empresario">Empresario</option>
                    <option value="Remesero">Remesero</option>
                </select>
                @error('tipo_cliente')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- 6 col --}}

            <h4 class="mt-4 mb-3 fw-bold">Datos de Reservación</h4>
            <hr>
         <!-- Datos de Reservación -->
         <div class="form-group col-md-4 mt-2">
            <label for="valor_reserva">Valor de la Reserva:</label>
            <input type="text" class="form-control @error('valor_reserva') is-invalid @enderror" name="valor_reserva" id="valor_reserva">
            @error('valor_reserva')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group col-md-4 mt-2">
            <label for="fecha_reserva">Fecha de la Reserva:</label>
            <input type="date" class="form-control @error('fecha_reserva') is-invalid @enderror" name="fecha_reserva" id="fecha_reserva">
            @error('fecha_reserva')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group col-md-4 mt-2">
            <label for="precio_venta">Precio de Venta:</label>
            <input type="text" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" id="precio_venta">
            @error('precio_venta')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- 7 col --}}

        <div class="form-group col-md-6 mt-2">
            <label for="prima">Prima:</label>
            <input type="text" class="form-control @error('prima') is-invalid @enderror" name="prima" id="prima">
            @error('prima')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group col-md-6 mt-2">
            <label for="valor_financiado">Valor Financiado:</label>
            <input type="text" class="form-control @error('valor_financiado') is-invalid @enderror" name="valor_financiado" id="valor_financiado">
            @error('valor_financiado')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <a href="{{ route('cliente.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('AfterScript')

<script>
    //validar DUI
    $(document).ready(function() {
        $('#dui').on('input', function() {
            let dui = $(this).val();
            dui = dui.replace(/\D/g, '');
            if (dui.length >= 8) {
                dui = dui.substr(0, 8) + '-' + dui.substr(8, 1);
            }
            $(this).val(dui);
        });
    });

    //validar numero de telefono
    $(document).ready(function() {
        $('#telefono').on('input', function() {
            let telefono = $(this).val();
            telefono = telefono.replace(/\D/g, '');
            if (telefono.length >= 4) {
                telefono = telefono.substr(0, 4) + '-' + telefono.substr(4, 4);
            }
            $(this).val(telefono);
        });
    });
</script>

@endsection

