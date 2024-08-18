<?php

namespace App\Http\Controllers;

use App\Models\Financiamiento;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $pagos = Pago::all();

            return view('pagos.index', compact('pagos'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('pago.index')->with('error', 'Error al cargar la página de pagos');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $financiamientos = Financiamiento::with('cliente', 'propiedad')->get()->pluck('descripcion', 'id_financiamiento');


            return view('pagos.create', compact('financiamientos'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('pago.index')->with('error', 'Error al cargar la página para agregar un pago');
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
