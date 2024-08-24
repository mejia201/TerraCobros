@extends('layouts/dashboard')
@section('title', 'Administrar propiedades')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administración de Propiedades</h5>
        <div class="card-body">
            <a href="{{ route('propiedad.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i>
                Agregar
            </a>



            <div class="table-responsive">
                @if ($propiedades->isEmpty())
                    <p class="text-center">No se encontraron registros de propiedades.</p>
                @else
                    <table id="miTabla" class="table text-nowrap mb-0 align-middle table-striped table-bordered">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><b>Lote</b></th>
                                <th class="border-bottom-0"><b>Area Terreno</b></th>
                                <th class="border-bottom-0"><b>Precio Por VRS</b></th>
                                <th class="border-bottom-0"><b>Precio Total</b></th>
                                <th class="border-bottom-0"><b>Estado</b></th>
                                <th><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($propiedades as $propiedad)
                                <tr>
                                    <td class="border-bottom-0">{{ $propiedad->id_propiedad }}</td>
                                    <td class="border-bottom-0">{{ number_format($propiedad->areaTerreno, 2, '.', ',') }}</td>
                                    <td class="border-bottom-0">{{ number_format($propiedad->precioPorVRS, 2, '.', ',') }}</td>
                                    <td class="border-bottom-0">{{ number_format($propiedad->precioTotal, 2, '.', ',') }}</td>
                                    <td class="border-bottom-0">
                                        @if($propiedad->estado == 'R')
                                            Reservado
                                        @else
                                            Disponible
                                        @endif
                                    </td>  
                                  
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('propiedad.edit', $propiedad->id_propiedad) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('propiedad.destroy', $propiedad->id_propiedad) }}" method="POST" id="delete-form-{{ $propiedad->id_propiedad }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $propiedad->id_propiedad }})">
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
