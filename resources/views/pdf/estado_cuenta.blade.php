<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta - {{ $cliente->nombre }} </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h2, h3 {
            margin: 15px 0 10px;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Estado de Cuenta</h1>
        <p>Cliente: {{ $cliente->nombre }}</p>
        <p>Código de Cliente: {{ $cliente->codclie }}</p>
        <p>Fecha de Generación: {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="cliente-info">
        <h2>Información del Cliente</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>DUI</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
            <tr>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->dui }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->email }}</td>
            </tr>
        </table>
    </div>

   
        <div class="financiamiento-info">
            <h2>Información de Financiamiento</h2>
            <table>
                <tr>
                    <th>Fecha de Inicio</th>
                    <th>Tasa de Interés</th>
                    <th>Plazo</th>
                    <th>Monto Pendiente</th>
                </tr>
                <tr>
                    <td>{{ $financiamiento->fechaInicio }}</td>
                    <td>{{ $financiamiento->tasaInteres }}%</td>
                    <td>{{ $financiamiento->plazoAnos }} años</td>
                    <td>${{ number_format($financiamiento->montoPendiente, 2) }}</td>
                </tr>
            </table>

            <h3>Información de la Propiedad</h3>
            <table>
                <tr>
                    <th>Polígono</th>
                    <th>Lote</th>
                    <th>Área del Terreno</th>
                    <th>Precio Total</th>
                    <th>Prima en Efectivo</th>
                </tr>
                <tr>
                    <td>{{ $financiamiento->propiedad->poligono }}</td>
                    <td>{{ $financiamiento->propiedad->lote }}</td>
                    <td>{{ $financiamiento->propiedad->areaTerreno }} m²</td>
                    <td>${{ number_format($financiamiento->propiedad->precioTotal, 2) }}</td>
                    <td>${{ number_format($financiamiento->propiedad->primaEnEfectivo, 2) }}</td>
                </tr>
            </table>

         
            <h3>Historial de Pagos</h3>
            <table>
                <tr>
                    <th>Cuota</th>
                    <th>Detalles</th>
                </tr>
                @forelse ($financiamiento->pagos as $pago)
                    <tr>
                        <td>{{ $pago->cuota }}</td>
                        <td>
                            <ul>
                                @forelse ($pago->detallePagos as $detalle)
                                <li>{{ \Carbon\Carbon::parse($detalle->fechaPago)->timezone('America/El_Salvador')->format('d-m-Y') }}: ${{ number_format($detalle->monto_total, 2) }}</li>
                                @empty
                                    <li>No hay detalles disponibles</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay pagos registrados.</td>
                    </tr>
                @endforelse
            </table>




        </div>
</body>
</html>
