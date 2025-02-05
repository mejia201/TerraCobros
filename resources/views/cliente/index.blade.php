@extends('layouts/dashboard')
@section('title', 'Administrar clientes')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administración de Clientes</h5>
        <div class="card-body">
            <a href="{{ route('cliente.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i>
                Agregar
            </a>



            <div class="table-responsive">
                @if ($clientes->isEmpty())
                    <p class="text-center">No se encontraron registros de clientes.</p>
                @else
                    <table id="miTabla" class="table text-nowrap mb-0 align-middle table-striped table-bordered">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><b>Código Cliente</b></th>
                                <th class="border-bottom-0"><b>DUI</b></th>
                                <th class="border-bottom-0"><b>Nombre</b></th>
                                <th class="border-bottom-0"><b>Teléfono</b></th>
                                <th class="border-bottom-0"><b>Email</b></th>
                                <th class="border-bottom-0"><b>Tipo</b></th>
                                <th><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="border-bottom-0">{{ $cliente->codclie }}</td>
                                    <td class="border-bottom-0">{{ $cliente->dui }}</td>
                                    <td class="border-bottom-0">{{ $cliente->nombre }}</td>
                                    <td class="border-bottom-0">{{ $cliente->telefono }}</td>
                                    <td class="border-bottom-0">{{ $cliente->email }}</td>
                                    <td class="border-bottom-0">{{ $cliente->tipo_cliente }}</td>
                                    <td class="d-flex gap-1 justify-content-center">

                                        @role('admin')
                                        <a href="{{ route('cliente.edit', $cliente->id_cliente) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('cliente.destroy', $cliente->id_cliente) }}" method="POST" id="delete-form-{{ $cliente->id_cliente }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cliente->id_cliente }})">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                         {{-- <a href="{{ route('cliente.descargarEstadoCuentaPDF', $cliente->id_cliente) }}" class="btn btn-secondary">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a> --}}

                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#seleccionarPropiedadModal-{{ $cliente->id_cliente }}">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </button>

                                        @endrole

                                        @role('invitado')
                                        <a href="{{ route('cliente.edit', $cliente->id_cliente) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#seleccionarPropiedadModal-{{ $cliente->id_cliente }}">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </button>
                                        
                                        @endrole


                                        @role('vendedor')

                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#seleccionarPropiedadModal-{{ $cliente->id_cliente }}">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </button>
                                        @endrole

                                    

                <!-- Modal para seleccionar la propiedad -->
                <div class="modal fade" id="seleccionarPropiedadModal-{{ $cliente->id_cliente }}" tabindex="-1" aria-labelledby="modalLabel-{{ $cliente->id_cliente }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel-{{ $cliente->id_cliente }}">Seleccionar Propiedad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                @foreach ($cliente->financiamientos as $financiamiento)
                                    <p class="mb-2">
                                        Poligono: {{ $financiamiento->propiedad->poligono }} - lote: {{ $financiamiento->propiedad->lote }}
                                        - Precio: ${{ $financiamiento->propiedad->precioTotal }}
                                    </p>
                                    <a href="{{ route('cliente.descargarEstadoCuentaPDF', ['id_cliente' => $cliente->id_cliente, 'id_financiamiento' => $financiamiento->id_financiamiento]) }}" class="btn btn-primary mb-2">
                                        Descargar Estado de Cuenta
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


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
