@extends('layouts/dashboard')
@section('title', 'Ingresar Pagos')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Pagos</h5>
    <div class="card-body">
        <form action="{{ route('pago.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf

            <h4 class="mt-4 mb-3 fw-bold">Carga de datos del financiamiento</h4>
            <hr>

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

            <div class="form-group col-md-4">
                <label for="data-cuota">Monto de la cuota:</label>
                <input type="text" class="form-control @error('data-cuota') is-invalid @enderror" name="data-cuota" id="data-cuota"  required readonly> 
                @error('data-cuota')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group col-md-6 mt-4">
                <button type="button" class="btn btn-primary" id="btnSeleccionarCuotas" disabled>Seleccionar Cuotas</button>
            </div>

            <div class="form-group col-md-12 mt-3">
                <label>Cuotas Seleccionadas:</label>
                <ul id="listaCuotasSeleccionadas" class="list-group"></ul>
            </div>

            <h4 class="mt-5 mb-3 fw-bold">Datos del pago a realizar</h4>
            <hr>

            {{-- <div class="form-group col-md-3 mt-2">
                <label for="fechaPago">Fecha del Pago:</label>
                <input type="date" class="form-control" name="fechaPago" id="fechaPago" value="{{ date('Y-m-d') }}" readonly>
            </div> --}}

            <div class="form-group col-md-3 mt-2">
                <label for="fechaPago">Fecha del Pago:</label>
                <input type="date" class="form-control" name="fechaPago" id="fechaPago">
            </div>
           

            <div class="form-group col-md-3 mt-2">
                <label for="montoPorMora">Monto adicional por retraso:</label>
                <input type="text" class="form-control" name="montoPorMora" id="montoPorMora" readonly>
            </div>

            <div class="form-group col-md-3 mt-2">
                <label for="moraAplicada">Mora aplicada (2%):</label>
                <input type="text" class="form-control" name="moraAplicada" id="moraAplicada" readonly >
            </div>

            <div class="form-group col-md-3 mt-2">
                <label for="montoTotal">Monto Total a Pagar:</label>
                <input type="text" class="form-control" name="montoTotal" id="montoTotal" readonly >
            </div>

            <div class="form-group col-md-12 mt-3">
                <label for="descripcion_pago">Descripción del Pago:</label>
                <textarea class="form-control" name="descripcion_pago" id="descripcion_pago" readonly></textarea>
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


            <input type="hidden" name="cuotasSeleccionadas" id="cuotasSeleccionadas">

            

            <div class="form-group col-md-12 mt-3 text-end">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <a href="{{ route('pago.index') }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>

    </div>
</div>

<!-- Modal de selección de cuotas -->
<div class="modal fade" id="modalCuotas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCuotasLabel">Seleccionar Cuotas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <ul id="listaCuotas" class="list-group"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnConfirmarCuotas">Confirmar</button>
            </div>
        </div>
    </div>
  </div>

@endsection

@section('AfterScript')
<script>

document.addEventListener("DOMContentLoaded", function () {
    var selectFinanciamiento = document.getElementById('id_financiamiento');
    var btnSeleccionarCuotas = document.getElementById('btnSeleccionarCuotas');

    selectFinanciamiento.addEventListener('change', function () {
        if (this.value) {
            btnSeleccionarCuotas.removeAttribute('disabled'); // Habilita el botón
        } else {
            btnSeleccionarCuotas.setAttribute('disabled', 'disabled'); // Lo deshabilita si no hay selección
        }
    });
});

document.getElementById('btnSeleccionarCuotas').addEventListener('click', function() {
    var idFinanciamiento = document.getElementById('id_financiamiento').value;
    var listaCuotas = document.getElementById('listaCuotas');
    var fechaSeleccionada = document.getElementById('fechaPago').value;
    listaCuotas.innerHTML = ''; 

    fetch('/pagos/' + idFinanciamiento + '/cuotas')
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                console.log("No hay cuotas disponibles.");
                return;
            }

            // console.log(data);
           
            let fechaPagoInput = new Date(fechaSeleccionada); // Fecha real de pago
            let fechaReferencia = new Date(data[0].fechaPagoEsperada); // Fecha esperada de la primera cuota

            data.forEach(function(cuota, index) {

                var montoCuota = cuota.montoPago;
                document.getElementById('data-cuota').value = montoCuota;

                let fechaCuota = new Date(cuota.fechaPagoEsperada);
                let diasMora = 0;

                if (index === 0) { 
                    // Primera cuota: Si se paga después de la fecha esperada, son 30 días de mora
                    diasMora = fechaPagoInput > fechaCuota ? 30 : 0;
                } else {
                    // Cuotas siguientes: Contar los días desde la fecha esperada de la cuota anterior
                    let diferenciaDias = Math.floor((fechaPagoInput - fechaReferencia) / (1000 * 60 * 60 * 24));
                    diasMora = diferenciaDias > 0 ? diferenciaDias : 0;
                }

                fechaReferencia = fechaCuota; // Actualizar referencia para la siguiente cuota

                var item = document.createElement('li');
                item.classList.add('list-group-item');

                var checkbox = `<input type="checkbox" class="cuota-checkbox" value="${cuota.id}" 
                                    data-cuota="${cuota.cuota}" 
                                    data-monto="${cuota.montoPago}" 
                                    data-fecha="${cuota.fechaPagoEsperada}" 
                                    data-dias="${diasMora}"> `;
                item.innerHTML = checkbox + `Cuota ${cuota.cuota} - Monto: $${cuota.montoPago} (Días de mora: ${diasMora})`;
                
                listaCuotas.appendChild(item);
            });

        })
        .catch(error => console.error("Error al obtener cuotas:", error));

    $('#modalCuotas').modal('show');
});




document.getElementById('btnConfirmarCuotas').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('.cuota-checkbox:checked');
    var listaSeleccionadas = document.getElementById('listaCuotasSeleccionadas');
    var montoTotalCuotas = 0;  
    var totalDiasMora = 0;  
    var descripcionPago = "";

    listaSeleccionadas.innerHTML = ''; 

    checkboxes.forEach(function(checkbox, index) {
        var montoCuota = parseFloat(checkbox.dataset.monto);
        var diasMora = parseInt(checkbox.dataset.dias);

        totalDiasMora += diasMora; 
        montoTotalCuotas += montoCuota; 

        var item = document.createElement('li');
        item.classList.add('list-group-item');
        item.textContent = `Cuota ${checkbox.dataset.cuota} - Monto: $${montoCuota.toFixed(2)} (Días de mora: ${diasMora})`;
        listaSeleccionadas.appendChild(item);

        descripcionPago += `Cuota ${checkbox.dataset.cuota}`;
        if (index !== checkboxes.length - 1) {
            descripcionPago += ", ";
        }
    });

    var montoCuotaReferencia = checkboxes.length > 0 ? parseFloat(checkboxes[0].dataset.monto) : 0;

    if(totalDiasMora == 0){

        moraBase = 0
        moraTotal = 0
        montoFinal = montoCuotaReferencia

    }else{

    // Calcular mora total basada en la suma de días de mora y el monto total de las cuotas
    var moraBase = ( montoCuotaReferencia / 30) * totalDiasMora;

    var moraTotal = moraBase * 0.02;
    // Calcular monto final a pagar
    var montoFinal = moraBase + moraTotal;

    }

   

    // Mostrar total de días de mora en el modal
    var moraInfo = document.createElement('li');
    moraInfo.classList.add('list-group-item', 'fw-bold');
    moraInfo.textContent = `Total de días de mora: ${totalDiasMora}`;
    listaSeleccionadas.appendChild(moraInfo);

    // Mostrar valores en el formulario
    document.getElementById('montoPorMora').value = moraBase.toFixed(2);
    document.getElementById('moraAplicada').value = moraTotal.toFixed(2);
    document.getElementById('montoTotal').value = montoFinal.toFixed(2);
    document.getElementById('descripcion_pago').value = descripcionPago;


    // Obtener las cuotas seleccionadas y agregarlas al campo oculto
var cuotasSeleccionadas = Array.from(checkboxes).map(cb => cb.dataset.cuota).join(',');
document.getElementById('cuotasSeleccionadas').value = cuotasSeleccionadas;



    $('#modalCuotas').modal('hide'); 
});



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