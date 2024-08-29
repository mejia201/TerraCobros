@extends('layouts/dashboard')
@section('title', 'Administrar financiamientos')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administración de Financiamientos</h5>
        <div class="card-body">
            <a href="{{ route('financiamiento.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i>
                Agregar
            </a>



            <div class="table-responsive">
                @if ($financiamientos->isEmpty())
                    <p class="text-center">No se encontraron registros de financiamientos.</p>
                @else
                    <table id="miTabla" class="table text-nowrap mb-0 align-middle table-striped table-bordered">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><b>Cliente</b></th>
                                <th class="border-bottom-0"><b>Propiedad</b></th>
                                <th class="border-bottom-0"><b>Plazo de años</b></th>
                                <th class="border-bottom-0"><b>Pago mensual</b></th>
                                <th class="border-bottom-0"><b>N. cuotas</b></th>
                                <th class="border-bottom-0"><b>Fecha Inicio</b></th>
                                <th><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($financiamientos as $financiamiento)
                                <tr>
                                    <td class="border-bottom-0">{{ $financiamiento->cliente->nombre }}</td>
                                    <td class="border-bottom-0">
                                        Lote: {{ $financiamiento->propiedad->id_propiedad }} - 
                                        Área: {{ number_format( $financiamiento->propiedad->areaTerreno, 2, '.', ',') }} VRS²
                                    </td>
                                    <td class="border-bottom-0">{{ $financiamiento->plazoAnos }}</td>
                                    <td class="border-bottom-0">{{ number_format($financiamiento->pagoMensual, 2, '.', ',') }}</td>

                                    <td class="border-bottom-0">{{ $financiamiento->numeroCuotas }}</td>
                                    <td class="border-bottom-0">{{ \Carbon\Carbon::parse($financiamiento->fechaInicio)->format('d-m-Y') }}</td>

                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('financiamiento.edit', $financiamiento->id_financiamiento) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('financiamiento.destroy', $financiamiento->id_financiamiento) }}" method="POST" id="delete-form-{{ $financiamiento->id_financiamiento }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $financiamiento->id_financiamiento }})">
                                                <i class="fa-solid fa-trash"></i>
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
