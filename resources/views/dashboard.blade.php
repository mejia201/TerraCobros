@extends('layouts/dashboard')
@section('title', 'Dashboard')
@section('contenido')
<div class="fs-6">

    <h4 class="mt-3 mb-5">Bienvenido, {{ Auth::user()->name }}</h4>


    <style>
    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
        
    <div class="card p-4 mt-3 mb-5" style="background-color: #f8f9fa; border-left: 5px solid #3498db; animation: fadeInDown 1s;">
        <div class="card-body d-flex align-items-center"> 
            <div>
                <h4 class="mb-0">Bienvenido, <strong>{{ Auth::user()->name }}</strong></h4>
                <p class="text-muted">Nos alegra tenerte de vuelta</p>
            </div>
            <div class="ms-auto">
                <i class="fas fa-smile-beam fa-3x text-primary"></i>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-6 col-12">
            @if($proximosPagos->isEmpty())
                <h5 class="text-center mt-5">No se encontraron pagos próximos a vencer.</h5>
            @else
                <div class="alert alert-warning" style="max-height: 300px; overflow-y: auto;">
                    <strong>Pagos próximos a vencer:</strong>
                    <ul>
                        @foreach($proximosPagos as $pago)
                            <li>{{ $pago->financiamiento->cliente->nombre }} - 
                                Monto: ${{ number_format($pago->montoPago, 2) }} - 
                                Fecha: {{ \Carbon\Carbon::parse($pago->fechaPagoEsperada)->format('d-m-Y') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    
        <div class="col-md-6 col-12">
            @if($pagosVencidos->isEmpty())
                <h5 class="text-center mt-5">No se encontraron pagos vencidos.</h5>
            @else
                <div class="alert alert-danger" style="max-height: 300px; overflow-y: auto;">
                    <strong>Pagos vencidos:</strong>
                    <ul>
                        @foreach($pagosVencidos as $pago)
                            <li>{{ $pago->financiamiento->cliente->nombre }} - 
                                Monto: ${{ number_format($pago->montoPago, 2) }} - 
                                Fecha de vencimiento: {{ \Carbon\Carbon::parse($pago->fechaPagoEsperada)->format('d-m-Y') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    

    
</div>
@endsection