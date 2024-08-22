@extends('layouts/dashboard')
@section('title', 'Realizar pagos')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administrar proceso para realizar pagos</h5>
        <div class="card-body">
            <a href="{{ route('cobro.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i>
                Agregar
            </a>



            <div class="table-responsive">
                @if ($detalles->isEmpty())
                    <p class="text-center">No se encontraron registros de pagos realizados.</p>
                @else
                    <table id="miTabla" class="table text-nowrap mb-0 align-middle table-striped table-bordered">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><b>Pago</b></th>
                                <th class="border-bottom-0"><b>Fecha pago</b></th>
                                <th class="border-bottom-0"><b>Monto a pagar</b></th>
                                <th class="border-bottom-0"><b>Mora</b></th>
                                <th class="border-bottom-0"><b>Monto total</b></th>
                                <th><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles as $detalle)
                                <tr>
                                    <td class="border-bottom-0">{{ $detalle->id_pago}}</td>
                                    <td class="border-bottom-0">{{ $detalle->fechaPago }}</td>
                                    <td class="border-bottom-0">{{ $detalle->montoPagado }}</td>
                                    <td class="border-bottom-0">{{ $detalle->monto_mora }}</td>
                                    <td class="border-bottom-0">{{ $detalle->monto_total }}</td>
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('cobro.edit', $detalle->id_detalle_pago) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('cobro.destroy', $detalle->id_detalle_pago) }}" method="POST" id="block-form-{{ $detalle->id_detalle_pago }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmBlock({{ $detalle->id_detalle_pago }})">
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            
        </div>
    </div>

@endsection


@section('AfterScript')



@endsection
