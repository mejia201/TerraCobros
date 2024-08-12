<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {

            $clientes = Cliente::all();

            return view('cliente.index', compact('clientes'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cliente.index')->with('error', 'Error al cargar la página de cliente');
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('cliente.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cliente.index')->with('error', 'Error al cargar la página para agregar un cliente');
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
