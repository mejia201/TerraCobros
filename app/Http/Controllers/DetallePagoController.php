<?php

namespace App\Http\Controllers;

use App\Models\DetallePago;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DetallePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $detalles = DetallePago::all();  
    
            return view('cobro.index', compact('detalles'));  
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cobro.index')->with('error', 'Error al cargar la página para registrar un pago');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $pagos = Pago::all()->pluck('descripcion', 'id_pago');

            return view('cobro.create', compact('pagos'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cobro.index')->with('error', 'Error al cargar la página para registrar un pago');
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
