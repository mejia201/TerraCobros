<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Financiamiento;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FinanciamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $financiamientos = Financiamiento::all();

            return view('financiamiento.index', compact('financiamientos'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('financiamiento.index')->with('error', 'Error al cargar la página de financiamientos');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $clientes = Cliente::pluck('nombre', 'id_cliente');
            $propiedades = Propiedad::pluck('areaTerreno', 'id_propiedad');


            return view('financiamiento.create', compact('clientes', 'propiedades'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('financiamiento.index')->with('error', 'Error al cargar la página para agregar un financiamiento');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
