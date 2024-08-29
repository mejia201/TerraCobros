@extends('layouts/dashboard')
@section('title', 'Administrar pagos')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administración de Pagos</h5>
        <div class="card-body">
            <a href="{{ route('pago.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i>
                Agregar
            </a>



            <div class="table-responsive">
                @if ($pagos->isEmpty())
                    <p class="text-center">No se encontraron registros de pagos.</p>
                @else
                    <table id="miTabla" class="table text-nowrap mb-0 align-middle table-striped table-bordered">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><b>Cliente</b></th>
                                <th class="border-bottom-0"><b>Fecha de Pago</b></th>
                                <th class="border-bottom-0"><b>Monto del Pago</b></th>
                                <th class="border-bottom-0"><b>Descripción</b></th>
                                <th class="border-bottom-0"><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <td class="border-bottom-0">{{ $pago->nombre }}</td>
                                    <td class="border-bottom-0">{{ \Carbon\Carbon::parse($pago->fechaPago)->format('d-m-Y') }}</td>
                                    <td class="border-bottom-0">{{ $pago->monto_total }}</td>
                                    <td class="border-bottom-0">{{ $pago->descripcion }}</td>
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('pago.edit', $pago->id_pago) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        {{-- <form action="{{ route('pago.destroy', $pago->id_pago) }}" method="POST" id="delete-form-{{ $pago->id_pago }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $pago->id_pago }})">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form> --}}
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
