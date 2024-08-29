<?php

namespace App\Http\Controllers;

use App\Models\DetallePago;
use App\Models\Financiamiento;
use App\Models\Pago;
use App\Models\Propiedad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $pagos = DB::table('detalle_pago')
            ->join('pago', 'detalle_pago.id_pago', '=', 'pago.id_pago')
            ->join('financiamiento', 'pago.id_financiamiento', '=', 'financiamiento.id_financiamiento')
            ->join('cliente', 'financiamiento.id_cliente', '=', 'cliente.id_cliente')
            ->select('cliente.nombre', 'detalle_pago.monto_total', 'detalle_pago.fechaPago', 'detalle_pago.descripcion', 'pago.id_pago')
            ->get();

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

    public function getCuotasByFinanciamiento($id_financiamiento)
    {
    try {
        $cuotas = Pago::where('id_financiamiento', $id_financiamiento)
                       ->where('estado', 'Pendiente') 
                       ->select('cuota', 'fechaPagoEsperada')
                       ->get();

        return response()->json($cuotas);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => 'Error al obtener las cuotas'], 500);
    }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Obtener los datos del formulario
            $idFinanciamiento = $request->input('id_financiamiento');
            $cuota = $request->input('cuota');
            $fechaPago = $request->input('fechaPago');
            $montoPago = $request->input('montoPago');
            $montoTotal = $request->input('monto_total');
            $montoMora = $request->input('montoMora');
            
            // Encontrar el financiamiento correspondiente
            //$financiamiento = Financiamiento::findOrFail($idFinanciamiento);

            $pago = Pago::where('id_financiamiento', $idFinanciamiento)
            ->where('cuota', $cuota)
            ->firstOrFail();
    
            // Crear el nuevo registro de pago
            // Pago::create([
            //     'id_financiamiento' => $idFinanciamiento,
            //     'cuota' => $cuota,
            //     'fechaPago' => $fechaPago,
            //     'fechaPagoEsperada' => $fechaPagoEsperada,
            //     'montoPago' => $montoPago,
            //     'monto_mora' => $montoMora,
            //     'monto_total' => $montoTotal,
            //     'estado' => 'Cancelado',
            // ]);


            $pago->update([
                'estado' => 'Cancelado',
            ]);


            DetallePago::create([
                'id_pago' => $pago->id_pago,
                'fechaPago' => $fechaPago,
                'montoPago' => $montoPago,
                'monto_mora' => $montoMora,
                'monto_total' => $montoTotal,
                'descripcion' => 'Pago de cuota ' . $cuota,
            ]);
    
            // Actualizar el monto pendiente en el financiamiento
            // $financiamiento->montoPendiente -= $montoPago;
            // $financiamiento->save();

            $financiamiento = Financiamiento::findOrFail($idFinanciamiento);
            $financiamiento->montoPendiente -= $montoPago;
            $financiamiento->save();
    
            DB::commit();
            return redirect()->route('pago.index')->with('success', 'Pago realizado exitosamente.');
    
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al realizar el pago: ' . $th->getMessage());
            return redirect()->route('pago.index')->with('error', 'Sucedió un error al realizar el pago.');
        }
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
        try {
            // Buscar financiamiento por su ID
            $pago = Pago::findOrFail($id);
            
            $pago->delete();
            
           
            return redirect()->route('pagos.index')->with('success', 'El registro del pago se elimino exitosamente.');
    
        } catch (\Exception $e) {
            Log::error('Error al eliminar el pago: ' . $e->getMessage());
                return redirect()->route('pagos.index')->with('error', 'Sucedió un error al intentar eliminar el registro del pago.');
        }
    }
}
