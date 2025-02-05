{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Pago de {{ $cliente->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        header {
            background-color: #5d87ff;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 4px solid #4b67b4;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        #details {
            margin: 20px auto;
            max-width: 900px;
            background: white;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        #company, #project {
            margin-bottom: 20px;
            padding: 10px 15px;
        }

        #company {
            float: left;
            text-align: left;
            width: 48%;
            border-right: 2px solid #e0e0e0;
        }

        #project {
            float: right;
            text-align: right;
            width: 48%;
        }

        #company div, #project div {
            margin-bottom: 10px;
        }

        #invoice {
            text-align: center;
            margin: 30px auto;
            background: #f2f2f2;
            padding: 15px 20px;
            border-radius: 8px;
        }

        #invoice h2 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        #invoice p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table .total {
            font-weight: bold;
            color: #4CAF50;
            text-align: right;
        }

        #notices {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #555;
        }

        #notices .notice {
            color: #d32f2f;
        }

        footer {
            text-align: center;
            color: #777;
            font-size: 0.8em;
            margin: 40px 0 10px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
<header>
    <h1>Notificación de pago</h1>
</header>
<div id="details" class="clearfix">
    <div id="company">
        <div><strong>Proyecto El Jobo</strong></div>
        <div>Santa Ana, El Salvador</div>
        <div>Tel: 7909-7980</div>
        <div>Email: <a href="mailto:correo@example.com">correo@example.com</a></div>
    </div>
    <div id="project">
        <div><strong>Código:</strong> {{ $cliente->codclie }}</div>
        <div><strong>Nombre:</strong> {{ $cliente->nombre }}</div>
        <div><strong>Polígono:</strong> {{ $propiedad->poligono }}</div>
        <div><strong>Lote:</strong> {{ $propiedad->lote }}</div>
        <div><strong>Fecha de Pago:</strong> {{ \Carbon\Carbon::parse($detallePago['fechaPago'])->timezone('America/El_Salvador')->format('d-m-Y') }}</div>
    </div>
</div>
<div id="invoice">
    <h2>Número de cuota: {{ $detallePago['cuota'] }}</h2>
    <p>Fecha de Generación: {{ now()->timezone('America/El_Salvador')->format('d-m-Y H:i:s') }}</p>
</div>
<main>
    <table>
        <thead>
            <tr>
                <th>Cuota</th>
                <th>Descripción</th>
                <th>Monto Efectuado</th>
                <th>Mora</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $detallePago['cuota'] }}</td>
                <td>{{ $detallePago['descripcion'] }}</td>
                <td>${{ number_format($detallePago['montoPago'], 2) }}</td>
                <td>${{ number_format($detallePago['montoMora'], 2) }}</td>
                <td class="total">${{ number_format($detallePago['montoTotal'], 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div id="notices">
        <div><strong> AVISO:</strong></div>
        <div class="notice"> Se aplicará un recargo financiero del 2% si no cumple con la fecha de pago.</div>
    </div>
</main>
<footer>
    Esta factura se generó electrónicamente y no requiere firma ni sello. Gracias por su pago.
</footer>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Pago de {{ $cliente->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        header {
            background-color: #5d87ff;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 4px solid #4b67b4;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        #details {
            margin: 20px auto;
            max-width: 900px;
            background: white;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        #company, #project {
            margin-bottom: 20px;
            padding: 10px 15px;
        }

        #company {
            float: left;
            text-align: left;
            width: 48%;
            border-right: 2px solid #e0e0e0;
        }

        #project {
            float: right;
            text-align: right;
            width: 48%;
        }

        #company div, #project div {
            margin-bottom: 10px;
        }

        #invoice {
            text-align: center;
            margin: 30px auto;
            background: #f2f2f2;
            padding: 15px 20px;
            border-radius: 8px;
        }

        #invoice h2 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        #invoice p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table .total {
            font-weight: bold;
            color: #4CAF50;
            text-align: right;
        }

        #notices {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #555;
        }

        #notices .notice {
            color: #d32f2f;
        }

        footer {
            text-align: center;
            color: #777;
            font-size: 0.8em;
            margin: 40px 0 10px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
<header>
    <h1>Notificación de pago</h1>
</header>
<div id="details" class="clearfix">
    <div id="company">
        <div><strong>Proyecto El Jobo</strong></div>
        <div>Santa Ana, El Salvador</div>
        <div>Tel: 7909-7980</div>
        <div>Email: <a href="mailto:correo@example.com">correo@example.com</a></div>
    </div>
    <div id="project">
        <div><strong>Código:</strong> {{ $cliente->codclie }}</div>
        <div><strong>Nombre:</strong> {{ $cliente->nombre }}</div>
        <div><strong>Polígono:</strong> {{ $propiedad->poligono }}</div>
        <div><strong>Lote:</strong> {{ $propiedad->lote }}</div>
        <div><strong>Fecha de Pago:</strong> 
            @foreach ($detallePago as $detalle)
                {{ \Carbon\Carbon::parse($detalle['fechaPago'])->timezone('America/El_Salvador')->format('d-m-Y') }}@if(!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>
<div id="invoice">
    <h2>Pago de {{ count($detallePago) }} cuota(s)</h2>
    <p>Fecha de Generación: {{ now()->timezone('America/El_Salvador')->format('d-m-Y H:i:s') }}</p>
</div>
<main>
    <table>
        <thead>
            <tr>
                <th>Cuota</th>
                <th>Descripción</th>
                <th>Monto Efectuado</th>
                <th>Mora</th>
                <th>Total</th>
                <th>Método de pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detallePago as $detalle)
                <tr>
                    <td>{{ $detalle['cuota'] }}</td>
                    <td>{{ $detalle['descripcion'] }}</td>
                    <td>${{ number_format($detalle['montoPago'], 2) }}</td>
                    <td>${{ number_format($detalle['monto_mora'], 2) }}</td>
                    <td class="total">${{ number_format($detalle['monto_total'], 2) }}</td>
                    <td>{{ $detalle['metodo_pago'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="notices">
        <div><strong> AVISO:</strong></div>
        <div class="notice"> Se aplicará un recargo financiero del 2% si no cumple con la fecha de pago.</div>
    </div>
</main>
<footer>
    Esta factura se generó electrónicamente y no requiere firma ni sello. Gracias por su pago.
</footer>
</body>
</html>

