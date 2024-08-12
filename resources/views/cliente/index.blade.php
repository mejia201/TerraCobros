@extends('layouts/dashboard')
@section('title', 'Administrar clientes')
@section('contenido')

    <div class="card mt-3">
        <h5 class="card-header">Administración de clientes</h5>
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
                                <th class="border-bottom-0"><b>DUI</b></th>
                                <th class="border-bottom-0"><b>Nombre</b></th>
                                <th class="border-bottom-0"><b>Teléfono</b></th>
                                <th class="border-bottom-0"><b>Email</b></th>
                                <th><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="border-bottom-0">{{ $cliente->dui }}</td>
                                    <td class="border-bottom-0">{{ $cliente->nombre }}</td>
                                    <td class="border-bottom-0">{{ $cliente->telefono }}</td>
                                    <td class="border-bottom-0">{{ $cliente->email }}</td>
                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('cliente.edit', $cliente->id_cliente) }}" class="btn btn-primary">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('cliente.destroy', $cliente->id_cliente) }}" method="POST" id="block-form-{{ $cliente->id_cliente }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmBlock({{ $cliente->id_cliente }})">
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
