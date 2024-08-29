@extends('layouts/dashboard')
@section('title', 'Ingresar Pagos')


@section('contenido')

<div class="card mt-3">
    <h5 class="card-header">Ingresar Pagos</h5>
    <div class="card-body">
        <form action="{{ route('pago.store') }}" method="post" class="row needs-validation" novalidate>
            @csrf


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
                <label for="montoPago">Monto del Pago:</label>
                <input type="text" class="form-control @error('montoPago') is-invalid @enderror" name="montoPago" id="montoPago"  required>
                @error('montoPago')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

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


            <!-- Total con mora -->
            <div class="form-group col-md-4 mt-2">
                <label for="monto_total">Monto Total a Pagar:</label>
                <input type="text" class="form-control" name="monto_total" id="monto_total" style="background-color: rgb(241, 237, 237)" readonly>
            </div>
            
            <div class="form-group col-md-4 mt-2">
                <label for="diferencia">Monto Adicional por Retraso en Pago:</label>
                <input type="text" class="form-control" id="diferencia" readonly>
            </div>
            

              <!-- Mensaje de retraso -->
              <div class="col-md-12 mt-2" id="retraso-container" style="display: none;">
                <div class="alert alert-warning">
                    El pago tiene un retraso de <span id="dias_retraso"></span> días. Se aplicará una mora del <span id="mora_aplicada"></span> %.
                </div>
            </div>

            
       
            <input type="hidden" name="montoMora" id="montoMora">


    
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

    // Limpiar el select de cuotas y el campo de fecha esperada
    cuotaSelect.innerHTML = '<option value="" disabled selected>Seleccione una cuota</option>';
    fechaPagoEsperada.value = '';

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

                    option.setAttribute('data-fecha', fechaFormateada);
                    cuotaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});

document.getElementById('cuota').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var fecha = selectedOption.getAttribute('data-fecha');
    document.getElementById('fechaPagoEsperada').value = fecha;
});

document.getElementById('fechaPago').addEventListener('change', function() {
    var fechaPago = new Date(this.value);
    var fechaPagoEsperada = new Date(document.getElementById('fechaPagoEsperada').value);
    var diasRetraso = Math.floor((fechaPago - fechaPagoEsperada) / (1000 * 60 * 60 * 24));

    if (diasRetraso > 0) {
        document.getElementById('mora-container').style.display = 'block';
        document.getElementById('retraso-container').style.display = 'block';
        document.getElementById('dias_retraso').textContent = diasRetraso;
    } else {
        document.getElementById('mora-container').style.display = 'none';
        document.getElementById('retraso-container').style.display = 'none';
        diasRetraso = 0; // No hay mora
    }
    calcularTotalConMora(diasRetraso);
});

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

    // Calcular monto de mora solo si hay retraso
    var montoMora = diasRetraso > 0 ? (montoPago * (porcentajeMora / 100)) * diasRetraso : 0;

    // Monto total es la suma del monto de pago y la mora
    var montoTotal = montoPago + montoMora;

    // Actualizar los campos en el formulario
    document.getElementById('monto_total').value = montoTotal.toFixed(2);
    document.getElementById('mora_aplicada').textContent = porcentajeMora.toFixed(2);
    document.getElementById('diferencia').value = montoMora.toFixed(2);
    document.getElementById('montoMora').value = montoMora.toFixed(2);

  
}

</script>
@endsection


