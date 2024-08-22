@extends('layouts/dashboard')
@section('title', 'Administrar pagos')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administración de informacion para pagos</h5>
        <div class="card-body">
            <a href="{{ route('pago.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i>
                Agregar
            </a>



            <div class="table-responsive">
                @if ($pagos->isEmpty())
                    <p class="text-center">No se encontraron registros de informacion para pagos.</p>
                @else
                    <table id="miTabla" class="table text-nowrap mb-0 align-middle table-striped table-bordered">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><b>Financiamiento</b></th>
                                <th class="border-bottom-0"><b>Fecha pago</b></th>
                                <th class="border-bottom-0"><b>Monto Pago</b></th>
                                <th class="border-bottom-0"><b>Fecha pago esperada</b></th>
                                <th><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <td class="border-bottom-0">{{ $pago->id_financiamiento }}</td>
                                    <td class="border-bottom-0">{{ $pago->id_propiedad}}</td>
                                    <td class="border-bottom-0">{{ $pago->tasaInteres }}</td>
                                    <td class="border-bottom-0">{{ $pago->plazoAnos }}</td>
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('pago.edit', $pago->id_pago) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('pago.destroy', $pago->id_pago) }}" method="POST" id="block-form-{{ $pago->id_pago }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmBlock({{ $pago->id_pago }})">
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
