<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $propiedades = Propiedad::all();

            return view('propiedad.index', compact('propiedades'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('propiedad.index')->with('error', 'Error al cargar la página de propiedades');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('propiedad.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cliente.index')->with('error', 'Error al cargar la página para agregar una propiedad');
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
