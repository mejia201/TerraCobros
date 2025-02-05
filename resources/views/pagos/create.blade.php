@extends('layouts/dashboard')
@section('title', 'Ingresar Pagos')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Pagos</h5>
    <div class="card-body">
        <form action="{{ route('pago.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf

            <h4 class="mt-4 mb-3 fw-bold">Carga de datos de la cuota</h4>
            <hr>

            <div class="form-group col-md-4">
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

            <div class="form-group col-md-4">
                <label for="cuota">Cuota:</label>
                <select class="form-control" name="cuota" id="cuota" required>
                    <option value="" disabled selected>Seleccione una cuota</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="fechaPagoEsperada">Fecha de Pago Esperada:</label>
                <input type="date" class="form-control @error('fechaPagoEsperada') is-invalid @enderror" name="fechaPagoEsperada" id="fechaPagoEsperada" readonly>
                @error('fechaPagoEsperada')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="fechaInicio">Fecha de Inicio del financiamiento:</label>
                <input type="date" class="form-control @error('fechaInicio') is-invalid @enderror" name="fechaInicio" id="fechaInicio" readonly>
                @error('fechaInicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group col-md-4 mt-2">
                <label for="montoPago">Monto del Pago:</label>
                <input type="text" class="form-control @error('montoPago') is-invalid @enderror" name="montoPago" id="montoPago"  required>
                @error('montoPago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
     
       
            <input type="hidden" name="montoMora" id="montoMora">



            <h4 class="mt-5 mb-3 fw-bold">Datos del pago a realizar</h4>
            <hr>

            <div class="form-group col-md-4 mt-2">
                <label for="fechaPago">Fecha del Pago:</label>
                <input type="date" class="form-control @error('fechaPago') is-invalid @enderror" name="fechaPago" id="fechaPago" required>
                @error('fechaPago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


             <!-- Campo para porcentaje de mora -->
             <div class="form-group col-md-4 mt-2" id="mora-container" style="display: none;">
                <label for="porcentaje_mora">Porcentaje de Mora (%):</label>
                <input type="number" class="form-control" name="porcentaje_mora" id="porcentaje_mora" value="0" step="0.01">
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="montoAdicional">Monto adicional por retraso:</label>
                <input type="text" class="form-control" id="montoAdicional" readonly>
            </div>

            <div class="form-group col-md-4 mt-2">
                <label for="diferencia">Monto total por mora:</label>
                <input type="text" class="form-control" id="diferencia" readonly>
            </div>

            <!-- Total con mora -->
            <div class="form-group col-md-4 mt-2">
                <label for="monto_total">Monto Total a Pagar:</label>
                <input type="text" class="form-control" name="monto_total" id="monto_total" style="background-color: rgb(241, 237, 237)" readonly>
            </div>
            
            
            
            
            <div class="form-group col-md-4 mt-2">
                <label for="metodo_pago">Método de Pago:</label>
                <select class="form-control @error('metodo_pago') is-invalid @enderror" name="metodo_pago" id="metodo_pago" required>
                    <option value="" disabled selected>Seleccione un método de pago</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Abono a cuenta">Abono a cuenta</option>
                </select>
                @error('metodo_pago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="form-group col-md-4 mt-2" id="cuenta-container" style="display: none;">
                <label for="numero_cuenta">Número de Cuenta:</label>
                <select class="form-control @error('numero_cuenta') is-invalid @enderror" name="numero_cuenta" id="numero_cuenta">
                    <option value="" disabled selected>Seleccione una cuenta</option>
                        <option value="00002">00002-Jose</option>
                </select>
                @error('numero_cuenta')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            

              <!-- Mensaje de retraso -->
              <div class="col-md-12 mt-2" id="retraso-container" style="display: none;">
                <div class="alert alert-warning">
                    El pago tiene un retraso de <span id="dias_retraso"></span> días. Se aplicará una mora del <span id="mora_aplicada"></span> %.
                </div>
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
<script>
document.getElementById('id_financiamiento').addEventListener('change', function() {
    var idFinanciamiento = this.value;
    var cuotaSelect = document.getElementById('cuota');
    var fechaPagoEsperada = document.getElementById('fechaPagoEsperada');
    var monto = document.getElementById('montoPago');

    // Limpiar el select de cuotas y el campo de fecha esperada
    cuotaSelect.innerHTML = '<option value="" disabled selected>Seleccione una cuota</option>';
    fechaPagoEsperada.value = '';
    monto.value = '';

    // Hacer una solicitud AJAX para obtener las cuotas
    if (idFinanciamiento) {
        fetch('/financiamientos/' + idFinanciamiento + '/cuotas')
            .then(response => response.json())
            .then(data => {
                data.forEach(function(cuota) {
                    var option = document.createElement('option');
                    option.value = cuota.cuota;
                    option.text = 'Cuota ' + cuota.cuota;

                    // Parsear la fecha para que esté en el formato correcto yyyy-MM-dd
                    var fechaEsperada = new Date(cuota.fechaPagoEsperada);
                    var fechaFormateada = fechaEsperada.toISOString().split('T')[0];
                    var montoCuota = cuota.montoPago;
                    var fecha_inicio = cuota.fechaInicio;

                    option.setAttribute('data-fecha', fechaFormateada);
                    option.setAttribute('data-monto', montoCuota);
                    option.setAttribute('data-fechaInicio', fecha_inicio);

                    cuotaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});

document.getElementById('cuota').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var fecha = selectedOption.getAttribute('data-fecha');
    var monto = selectedOption.getAttribute('data-monto');
    var fechaIni = selectedOption.getAttribute('data-fechaInicio');
    document.getElementById('fechaPagoEsperada').value = fecha;
    document.getElementById('montoPago').value = monto;
    document.getElementById('fechaInicio').value = fechaIni;
    
});



document.getElementById('fechaPago').addEventListener('change', function() {
    var fechaPago = new Date(this.value);
    var fechaPagoEsperada = new Date(document.getElementById('fechaPagoEsperada').value);
    var fechaInicio = new Date(document.getElementById('fechaInicio').value); // Obtener fecha de inicio

    var fechaInicioTolerancia = new Date(fechaPagoEsperada);
    fechaInicioTolerancia.setDate(fechaPagoEsperada.getDate() - 1);

    var fechaFinTolerancia = new Date(fechaPagoEsperada);
    fechaFinTolerancia.setDate(fechaPagoEsperada.getDate() + 1);

    var diasRetraso = 0;

    if (fechaPago < fechaInicioTolerancia) {
        document.getElementById('mora-container').style.display = 'none';
        document.getElementById('retraso-container').style.display = 'none';
    } else if (fechaPago > fechaFinTolerancia) {
        diasRetraso = calcularMora(fechaInicio, fechaPago); // Nuevo cálculo con meses de 30 días
        document.getElementById('mora-container').style.display = 'block';
        document.getElementById('retraso-container').style.display = 'block';
        document.getElementById('dias_retraso').textContent = diasRetraso;
    } else {
        document.getElementById('mora-container').style.display = 'none';
        document.getElementById('retraso-container').style.display = 'none';
    }

    calcularTotalConMora(diasRetraso);
});

// Función para calcular la mora con meses de 30 días
function calcularMora(fechaInicio, fechaPago) {
    let inicio = new Date(fechaInicio);
    let pago = new Date(fechaPago);

    let añosDiferencia = pago.getFullYear() - inicio.getFullYear();
    let mesesDiferencia = (añosDiferencia * 12) + (pago.getMonth() - inicio.getMonth());
    let diasDiferencia = (pago.getDate() - inicio.getDate());

    let diasMora = (mesesDiferencia * 30) + diasDiferencia;
    return diasMora;
}



document.getElementById('montoPago').addEventListener('input', function() {
    var diasRetraso = parseInt(document.getElementById('dias_retraso').textContent) || 0;
    calcularTotalConMora(diasRetraso);
});

document.getElementById('porcentaje_mora').addEventListener('input', function() {
    var diasRetraso = parseInt(document.getElementById('dias_retraso').textContent) || 0;
    calcularTotalConMora(diasRetraso);
});


function calcularTotalConMora(diasRetraso) {
    var montoPago = parseFloat(document.getElementById('montoPago').value) || 0;
    var porcentajeMora = parseFloat(document.getElementById('porcentaje_mora').value) || 0;

    // Calcular el monto adicional sin mora por retraso
    var totalSinMora = (montoPago / 30) * diasRetraso;

    // Calcular monto de mora aplicando el porcentaje ingresado
    var montoMora = (totalSinMora * (porcentajeMora / 100));

    document.getElementById('montoAdicional').value = totalSinMora.toFixed(2); 

    // Monto total a pagar
    var montoTotal = totalSinMora + montoMora;

    // Actualizar los campos en el formulario
    document.getElementById('monto_total').value = montoTotal.toFixed(2);
    document.getElementById('mora_aplicada').textContent = porcentajeMora.toFixed(2);
    document.getElementById('diferencia').value = montoMora.toFixed(2);
    document.getElementById('montoMora').value = montoMora.toFixed(2);
}


document.getElementById('metodo_pago').addEventListener('change', function() {
    var metodoSeleccionado = this.value;
    var cuentaContainer = document.getElementById('cuenta-container');
    
    // Mostrar el campo de cuenta solo para Transferencia o Abono a cuenta
    if (metodoSeleccionado === 'Transferencia' || metodoSeleccionado === 'Abono a cuenta') {
        cuentaContainer.style.display = 'block';
    } else {
        cuentaContainer.style.display = 'none';
    }
});



</script>
@endsection


