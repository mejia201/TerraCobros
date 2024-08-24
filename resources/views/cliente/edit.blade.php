@extends('layouts/dashboard')
@section('title', 'Editar Cliente')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Editar información del cliente</h5>
        <div class="card-body">
            <form action="{{ route('cliente.update', $cliente->id_cliente) }}" method="post" class="row needs-validation" novalidate>
                @csrf
                @method('PUT')
    
                <!-- Barra de navegación -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Información General</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="laboral-tab" data-bs-toggle="tab" href="#laboral" role="tab" aria-controls="laboral" aria-selected="false">Información Laboral</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="referencias-tab" data-bs-toggle="tab" href="#referencias" role="tab" aria-controls="referencias" aria-selected="false">Referencias</a>
                    </li>
                </ul>
    
                <!-- Contenido de las pestañas -->
                <div class="tab-content mt-3 mb-4" id="myTabContent">
                    <!-- Información General -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="dui">DUI: *</label>
                                <input type="text" class="form-control @error('dui') is-invalid @enderror" name="dui" id="dui" value="{{$cliente->dui}}" required>
                                @error('dui')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-8">
                                <label for="nombre">Nombre: *</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{$cliente->nombre}}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="telefono">Teléfono: *</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" value="{{$cliente->telefono}}" required>
                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="email">Correo electrónico: *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$cliente->email}}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="fecha_nacimiento">Fecha de Nacimiento: *</label>
                                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" id="fecha_nacimiento" value="{{$cliente->fecha_nacimiento}}"  onchange="calcularEdad()">
                                @error('fecha_nacimiento')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="edad">Edad: *</label>
                                <input type="number" class="form-control @error('edad') is-invalid @enderror" name="edad" id="edad" value="{{$cliente->edad}}">
                                @error('edad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            <div class="form-group col-md-4 mt-2">
                                <label for="sexo">Sexo: *</label>
                                <select class="form-control @error('sexo') is-invalid @enderror" name="sexo" id="sexo">
                                    <option value="Masculino" {{ $cliente->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ $cliente->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ $cliente->sexo == 'Otro' ? 'selected' : '' }}>Otro</option>

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
                            
                                    <option value="Soltero" {{ $cliente->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                    <option value="Casado" {{ $cliente->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                                    <option value="Divorciado" {{ $cliente->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                    <option value="Viudo" {{ $cliente->estado_civil == 'Viudo' ? 'selected' : '' }}>Viudo</option>

                                </select>
                                @error('estado_civil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-12 mt-2">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="{{$cliente->direccion}}">
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="nacionalidad">Nacionalidad:</label>
                                <input type="text" class="form-control @error('nacionalidad') is-invalid @enderror" name="nacionalidad" id="nacionalidad" value="{{$cliente->nacionalidad}}">
                                @error('nacionalidad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="pais_nacimiento">País de Nacimiento:</label>
                                <input type="text" class="form-control @error('pais_nacimiento') is-invalid @enderror" name="pais_nacimiento" id="pais_nacimiento" value="{{$cliente->pais_nacimiento}}">
                                @error('pais_nacimiento')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="estatus">Estatus:</label>
                                <input type="text" class="form-control @error('estatus') is-invalid @enderror" name="estatus" id="estatus" value="{{$cliente->estatus}}">
                                @error('estatus')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-8 mt-2">
                                <label for="medio_enterado">Medio por el que se enteró:</label>
                                <input type="text" class="form-control @error('medio_enterado') is-invalid @enderror" name="medio_enterado" id="medio_enterado" value="{{$cliente->medio_enterado}}" >
                                @error('medio_enterado')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="tipo_cliente">Tipo de Cliente: *</label>
                                <select class="form-control @error('tipo_cliente') is-invalid @enderror" name="tipo_cliente" id="tipo_cliente">
                                  
                                    <option value="Comerciante" {{ $cliente->tipo_cliente == 'Comerciante' ? 'selected' : '' }}>Comerciante</option>
                                    <option value="Empleado" {{ $cliente->tipo_cliente == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                                    <option value="Extranjero" {{ $cliente->tipo_cliente == 'Extranjero' ? 'selected' : '' }}>Extranjero</option>
                                    <option value="Empresario" {{ $cliente->tipo_cliente == 'Empresario' ? 'selected' : '' }}>Empresario</option>
                                    <option value="Remesero" {{ $cliente->tipo_cliente == 'Remesero' ? 'selected' : '' }}>Remesero</option>


                                </select>
                                @error('tipo_cliente')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <h4 class="mt-4 mb-3 fw-bold">Datos de Reservación</h4>
                            <hr>
                            
                            <div class="form-group col-md-4 mt-2">
                                <label for="valor_reserva">Valor de la Reserva:</label>
                                <input type="text" class="form-control @error('valor_reserva') is-invalid @enderror" name="valor_reserva" id="valor_reserva" value="{{$cliente->valor_reserva}}">
                                @error('valor_reserva')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="fecha_reserva">Fecha de la Reserva:</label>
                                <input type="date" class="form-control @error('fecha_reserva') is-invalid @enderror" name="fecha_reserva" id="fecha_reserva" value="{{$cliente->fecha_reserva}}">
                                @error('fecha_reserva')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="precio_venta">Precio Venta:</label>
                                <input type="text" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" id="precio_venta" value="{{$cliente->precio_venta}}">
                                @error('precio_venta')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-4 mt-2">
                                <label for="prima">Prima:</label>
                                <input type="text" class="form-control @error('prima') is-invalid @enderror" name="prima" id="prima" value="{{$cliente->prima}}">
                                @error('prima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-4 mt-2">
                                <label for="valor_financiado">Valor Financiado:</label>
                                <input type="text" class="form-control @error('valor_financiado') is-invalid @enderror" name="valor_financiado" id="valor_financiado" value="{{$cliente->valor_financiado}}">
                                @error('valor_financiado')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                        </div>
                    </div>
                    
                    <!-- Información Laboral -->
                    <div class="tab-pane fade" id="laboral" role="tabpanel" aria-labelledby="laboral-tab">
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label for="estado_laboral">Estado Laboral:</label>
                                <select class="form-control @error('estado_laboral') is-invalid @enderror" name="estado_laboral" id="estado_laboral">
                                    <option value="Empleado">Empleado</option>
                                    <option value="Comerciante">Comerciante</option>
                                    <option value="Empresario">Empresario</option>
                                    <option value="Remesero">Remesero</option>
                                    <option value="Desempleado">Desempleado</option>

                                    <option value="Comerciante" {{ $cliente->informacionLaboral->estado_laboral == 'Comerciante' ? 'selected' : '' }}>Comerciante</option>
                                    <option value="Empleado" {{ $cliente->informacionLaboral->estado_laboral == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                                    <option value="Desempleado" {{ $cliente->informacionLaboral->estado_laboral == 'Desempleado' ? 'selected' : '' }}>Desempleado</option>
                                    <option value="Empresario" {{ $cliente->informacionLaboral->estado_laboral == 'Empresario' ? 'selected' : '' }}>Empresario</option>
                                    <option value="Remesero" {{ $cliente->informacionLaboral->estado_laboral == 'Remesero' ? 'selected' : '' }}>Remesero</option>

                                </select>
                                @error('estado_laboral')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6">
                                <label for="nombre_empresa">Nombre de la Empresa:</label>
                                <input type="text" class="form-control @error('nombre_empresa') is-invalid @enderror" name="nombre_empresa" id="nombre_empresa" value="{{$cliente->informacionLaboral->nombre_empresa}}">
                                @error('nombre_empresa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="direccion_empresa">Dirección de la Empresa:</label>
                                <input type="text" class="form-control @error('direccion_empresa') is-invalid @enderror" name="direccion_empresa" id="direccion_empresa" value="{{$cliente->informacionLaboral->direccion_empresa}}">
                                @error('direccion_empresa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="cargo">Cargo:</label>
                                <input type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" id="cargo" value="{{$cliente->informacionLaboral->cargo}}" >
                                @error('cargo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="telefono_empresa">Teléfono de la Empresa:</label>
                                <input type="text" class="form-control @error('telefono_empresa') is-invalid @enderror" name="telefono_empresa" id="telefono_empresa" value="{{$cliente->informacionLaboral->telefono_empresa}}" >
                                @error('telefono_empresa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="tiempo_en_empresa">Tiempo en la Empresa:</label>
                                <input type="text" class="form-control @error('tiempo_en_empresa') is-invalid @enderror" name="tiempo_en_empresa" id="tiempo_en_empresa" value="{{$cliente->informacionLaboral->tiempo_en_empresa}}">
                                @error('tiempo_en_empresa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="jefe_inmediato">Jefe Inmediato:</label>
                                <input type="text" class="form-control @error('jefe_inmediato') is-invalid @enderror" name="jefe_inmediato" id="jefe_inmediato" value="{{$cliente->informacionLaboral->jefe_inmediato}}" >
                                @error('jefe_inmediato')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="telefono_jefe">Teléfono del Jefe:</label>
                                <input type="text" class="form-control @error('telefono_jefe') is-invalid @enderror" name="telefono_jefe" id="telefono_jefe" value="{{$cliente->informacionLaboral->telefono_jefe}}">
                                @error('telefono_jefe')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="registro_iva">Registro IVA:</label>
                                <input type="text" class="form-control @error('registro_iva') is-invalid @enderror" name="registro_iva" id="registro_iva" value="{{$cliente->informacionLaboral->registro_iva}}">
                                @error('registro_iva')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="tipo_negocio">Tipo de Negocio:</label>
                                <input type="text" class="form-control @error('tipo_negocio') is-invalid @enderror" name="tipo_negocio" id="tipo_negocio" value="{{$cliente->informacionLaboral->tipo_negocio}}">
                                @error('tipo_negocio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="salario_mensual">Salario Mensual:</label>
                                <input type="text" class="form-control @error('salario_mensual') is-invalid @enderror" name="salario_mensual" id="salario_mensual" value="{{$cliente->informacionLaboral->salario_mensual}}">
                                @error('salario_mensual')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="ingresos_adicionales">Ingresos Adicionales:</label>
                                <input type="text" class="form-control @error('ingresos_adicionales') is-invalid @enderror" name="ingresos_adicionales" id="ingresos_adicionales" value="{{$cliente->informacionLaboral->ingresos_adicionales}}">
                                @error('ingresos_adicionales')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                
                            <div class="form-group col-md-6 mt-2">
                                <label for="remesas">Remesas:</label>
                                <input type="text" class="form-control @error('remesas') is-invalid @enderror" name="remesas" id="remesas" value="{{$cliente->informacionLaboral->remesas}}">
                                @error('remesas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <!-- Referencias -->
        <div class="tab-pane fade" id="referencias" role="tabpanel" aria-labelledby="referencias-tab">
            <div class="row">
                <div id="referencias-container">
                    @foreach($cliente->referencias as $index => $referencia)
                        <div class="reference-row mt-3 border rounded p-3">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="referencias[{{ $index }}][tipo]">Tipo de Referencia: *</label>
                                    <select class="form-control @error('referencias.' . $index . '.tipo') is-invalid @enderror" name="referencias[{{ $index }}][tipo]" id="referencias[{{ $index }}][tipo]" required>
                                        <option value="personal" {{ $referencia->tipo === 'personal' ? 'selected' : '' }}>Personal</option>
                                        <option value="laboral" {{ $referencia->tipo === 'laboral' ? 'selected' : '' }}>Laboral</option>
                                    </select>
                                    @error('referencias.' . $index . '.tipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-group col-md-6">
                                    <label for="referencias[{{ $index }}][nombre]">Nombre de la Referencia: *</label>
                                    <input type="text" class="form-control @error('referencias.' . $index . '.nombre') is-invalid @enderror" name="referencias[{{ $index }}][nombre]" id="referencias[{{ $index }}][nombre]" value="{{ old('referencias.' . $index . '.nombre', $referencia->nombre) }}" required>
                                    @error('referencias.' . $index . '.nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-group col-md-6 mt-2">
                                    <label for="referencias[{{ $index }}][telefono]">Teléfono:</label>
                                    <input type="text" class="form-control @error('referencias.' . $index . '.telefono') is-invalid @enderror" name="referencias[{{ $index }}][telefono]" id="referencias[{{ $index }}][telefono]" value="{{ old('referencias.' . $index . '.telefono', $referencia->telefono) }}">
                                    @error('referencias.' . $index . '.telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-group col-md-6 mt-2">
                                    <label for="referencias[{{ $index }}][direccion]">Dirección:</label>
                                    <input type="text" class="form-control @error('referencias.' . $index . '.direccion') is-invalid @enderror" name="referencias[{{ $index }}][direccion]" id="referencias[{{ $index }}][direccion]" value="{{ old('referencias.' . $index . '.direccion', $referencia->direccion) }}">
                                    @error('referencias.' . $index . '.direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <!-- Botón para eliminar la referencia -->
                            @if($index > 0)
                                <button type="button" class="btn btn-danger mt-2" onclick="removeReference(this)">Eliminar</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Botón para agregar nuevas referencias -->
                <div class="form-group col-md-12 mt-3">
                    
                    <button type="button" class="btn btn-success mt-3" onclick="addReference()">Agregar Nueva Referencia</button>

                </div>
           
            </div>


            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Actualizar">
                <a href="{{ route('cliente.index') }}" class="btn btn-dark">Regresar</a>
            </div>

            </div>
            </div>
    
                
            </form>
        </div>
    </div>

@endsection



@section('AfterScript')
<script>
    // Validación DUI y teléfono
    $(document).ready(function() {
        $('#dui').on('input', function() {
            let dui = $(this).val();
            dui = dui.replace(/\D/g, '');
            if (dui.length >= 8) {
                dui = dui.substr(0, 8) + '-' + dui.substr(8, 1);
            }
            $(this).val(dui);
        });

        $('#telefono').on('input', function() {
            let telefono = $(this).val();
            telefono = telefono.replace(/\D/g, '');
            if (telefono.length >= 4) {
                telefono = telefono.substr(0, 4) + '-' + telefono.substr(4, 4);
            }
            $(this).val(telefono);
        });

        $('#telefono_empresa').on('input', function() {
            let telefono = $(this).val();
            telefono = telefono.replace(/\D/g, '');
            if (telefono.length >= 4) {
                telefono = telefono.substr(0, 4) + '-' + telefono.substr(4, 4);
            }
            $(this).val(telefono);
        });

        $('#telefono_jefe').on('input', function() {
            let telefono = $(this).val();
            telefono = telefono.replace(/\D/g, '');
            if (telefono.length >= 4) {
                telefono = telefono.substr(0, 4) + '-' + telefono.substr(4, 4);
            }
            $(this).val(telefono);
        });

        $(document).ready(function() {
    
        $(document).on('input', 'input[name^="referencias["][name$="[telefono]"]', function() {
            let telefono = $(this).val();
            telefono = telefono.replace(/\D/g, ''); 
            if (telefono.length >= 4) {
                telefono = telefono.substr(0, 4) + '-' + telefono.substr(4, 4);
            }
            $(this).val(telefono);
        });
});


      
    });


    function calcularEdad() {
        var fechaNacimiento = document.getElementById('fecha_nacimiento').value;
        var fechaActual = new Date();
        var fechaNac = new Date(fechaNacimiento);

        if (fechaNac.getTime() > fechaActual.getTime()) {
            document.getElementById('edad').value = '';
            return;
        }

        var edad = fechaActual.getFullYear() - fechaNac.getFullYear();
        var m = fechaActual.getMonth() - fechaNac.getMonth();

        if (m < 0 || (m === 0 && fechaActual.getDate() < fechaNac.getDate())) {
            edad--;
        }

        document.getElementById('edad').value = edad;
    }
</script>


<!-- Scripts para manejar la adición y eliminación de referencias -->
<script>
    let referenceIndex = {{ count($cliente->referencias) }};
    
    function addReference() {
        const container = document.getElementById('referencias-container');
        const newReference = document.createElement('div');
        newReference.classList.add('reference-row', 'mt-3', 'border', 'rounded', 'p-3');
        newReference.innerHTML = `
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="referencias[${referenceIndex}][tipo]">Tipo de Referencia: *</label>
                    <select class="form-control @error('referencias.${referenceIndex}.tipo') is-invalid @enderror" name="referencias[${referenceIndex}][tipo]" id="referencias[${referenceIndex}][tipo]" required>
                        <option value="personal">Personal</option>
                        <option value="laboral">Laboral</option>
                    </select>
                    @error('referencias.${referenceIndex}.tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-md-6">
                    <label for="referencias[${referenceIndex}][nombre]">Nombre de la Referencia: *</label>
                    <input type="text" class="form-control @error('referencias.${referenceIndex}.nombre') is-invalid @enderror" name="referencias[${referenceIndex}][nombre]" id="referencias[${referenceIndex}][nombre]" required>
                    @error('referencias.${referenceIndex}.nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-md-6 mt-2">
                    <label for="referencias[${referenceIndex}][telefono]">Teléfono:</label>
                    <input type="text" class="form-control @error('referencias.${referenceIndex}.telefono') is-invalid @enderror" name="referencias[${referenceIndex}][telefono]" id="referencias[${referenceIndex}][telefono]">
                    @error('referencias.${referenceIndex}.telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-md-6 mt-2">
                    <label for="referencias[${referenceIndex}][direccion]">Dirección:</label>
                    <input type="text" class="form-control @error('referencias.${referenceIndex}.direccion') is-invalid @enderror" name="referencias[${referenceIndex}][direccion]" id="referencias[${referenceIndex}][direccion]">
                    @error('referencias.${referenceIndex}.direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="button" class="btn btn-danger mt-2" onclick="removeReference(this)">Eliminar</button>
        `;
        container.appendChild(newReference);
        referenceIndex++;
    }
    
    function removeReference(button) {
        button.parentElement.remove();
    }
</script>
@endsection