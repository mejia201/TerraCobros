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
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


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
            ->select('cliente.nombre', 'detalle_pago.montoTotal', 'detalle_pago.fechaPago', 'detalle_pago.descripcion', 'detalle_pago.id_detalle_pago')
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

              // $fechaHoy = Carbon::create(2025, 2, 13)->toDateString();
            // $fechaHoy = Carbon::now()->toDateString();

              // Si no se proporciona fecha, usa la fecha actual




    /**
     * Store a newly created resource in storage.
     */


    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         // Obtener los datos del formulario
    //         $idFinanciamiento = $request->input('id_financiamiento');
    //         $cuota = $request->input('cuota');
    //         $fechaPago = $request->input('fechaPago');
    //         $montoPago = $request->input('subtotal');
    //         $montoMora = $request->input('monto_mora');
    //         $montoTotal = $request->input('monto_total');
    //         $descripcion = $request->input('descripcion_pago');
    //         $metodo_pago = $request->input('metodo_pago');
    //         $numero_cuenta = $request->input('numero_cuenta');
    //         $montoCuota = $request->input('data-cuota');


    //         $pago = Pago::where('id_financiamiento', $idFinanciamiento)
    //         ->where('cuota', $cuota)
    //         ->firstOrFail();
    
    //         $pago->update([
    //             'estado' => 'Cancelado',
    //         ]);


    //         DetallePago::create([
    //             'id_pago' => $pago->id_pago,
    //             'fechaPago' => $fechaPago,
    //             'montoPago' => $montoPago,
    //             'monto_mora' => $montoMora,
    //             'monto_total' => $montoTotal,
    //             'metodo_pago' => $metodo_pago,
    //             'numero_cuenta' => $numero_cuenta,
    //             'descripcion' => $descripcion,
    //         ]);
    
    //         $financiamiento = Financiamiento::findOrFail($idFinanciamiento);

    //         // Verificar si el monto a pagar excede el monto pendiente
    //         if ($financiamiento->montoPendiente < $montoPago) {
    //             $financiamiento->montoPendiente = 0; // No puede quedar deuda negativa
    //         } else {
    //             $financiamiento->montoPendiente -= $montoPago; // Descontar el monto del pago
    //         }
            
    //         $financiamiento->save();


    //         // Datos para la factura
    //         $cliente = $financiamiento->cliente; // Relación con cliente
    //         $propiedad = $financiamiento->propiedad;

    //         $data = [
    //             'cliente' => $cliente,
    //             'financiamiento' => $financiamiento,
    //             'pago' => $pago,
    //             'propiedad' => $propiedad,
    //             'detallePago' => [
    //                 'fechaPago' => $fechaPago,
    //                 'montoPago' => $montoPago,
    //                 'montoMora' => $montoMora,
    //                 'montoTotal' => $montoTotal,
    //                 'descripcion' => 'Pago de cuota ' . $cuota,
    //                 'cuota' => $cuota
    //             ],
    //         ];

    //             // Generar el PDF
    //             $pdf = PDF::loadView('pdf.factura', $data);
    //             // Verificar si el directorio existe, si no, crearlo
    //             $pdfDirectory = storage_path('app/public/facturas/');
    //             if (!file_exists($pdfDirectory)) {
    //                 mkdir($pdfDirectory, 0755, true);
    //             }

    //             $pdfPath = storage_path('app/public/facturas/') . 'factura_' . $pago->id_pago . '.pdf';
    //             $pdf->save($pdfPath);

    //              // Enviar el PDF al correo del cliente con la factura
               
    //              Mail::to($cliente->email)->send(new \App\Mail\cobroMail($pdfPath, $data));

    
    //         DB::commit();
    //         return redirect()->route('pago.index')->with('success', 'Pago realizado exitosamente.');
    
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         Log::error('Error al realizar el pago: ' . $th->getMessage());
    //         return redirect()->route('pago.index')->with('error', 'Sucedió un error al realizar el pago.');
    //     }
    // }



    public function getCuotasByFinanciamiento($id_financiamiento)
    {
        try {
 
            //  $fechaHoy = Carbon::create(2025, 2, 9)->toDateString();
            $fechaHoy = Carbon::now()->toDateString();
             
            $cuotas = Pago::where('pago.id_financiamiento', $id_financiamiento)
            ->where(function ($query) use ($fechaHoy) {
                $query->whereDate('pago.fechaPagoEsperada', '<=', $fechaHoy) // Cuotas vencidas
                    ->orwhereDate('pago.fechaPagoEsperada', '=', $fechaHoy); // Cuota actual
            })
            ->where('pago.estado', 'Pendiente')
            ->join('financiamiento', 'pago.id_financiamiento', '=', 'financiamiento.id_financiamiento')
            ->select('pago.id_pago', 'pago.cuota', 'pago.fechaPagoEsperada', 'pago.montoPago', 'financiamiento.fechaInicio')
            ->orderBy('pago.fechaPagoEsperada', 'asc')
            ->get();



            if ($cuotas->isEmpty()) {
                return response()->json([]);
            }
    
             return response()->json($cuotas);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error al obtener las cuotas'], 500);
        }
    } 


public function store(Request $request)
{
    DB::beginTransaction();
    try {
        Log::info('Iniciando proceso de pago');

        // Obtener los datos del formulario
        $idFinanciamiento = $request->input('id_financiamiento');
        $cuotasSeleccionadas = $request->input('cuotasSeleccionadas', []);
        if (!is_array($cuotasSeleccionadas)) {
            $cuotasSeleccionadas = explode(',', $cuotasSeleccionadas);
        }

        $fechaPago = $request->input('fechaPago');
        $montoCuota = $request->input('data-cuota');

        $montoPorMora = $request->input('montoPorMora');
        $moraAplicada = $request->input('moraAplicada');
        $montoTotal = $request->input('montoTotal');
        $descripcion = $request->input('descripcion_pago');
        $metodo_pago = $request->input('metodo_pago');
        $numero_cuenta = $request->input('numero_cuenta');

        Log::info('Datos recibidos', compact(
            'idFinanciamiento', 'cuotasSeleccionadas', 'fechaPago', 'montoCuota',
            'montoPorMora', 'moraAplicada', 'montoTotal', 'metodo_pago', 'numero_cuenta'
        ));

        // Buscar el financiamiento
        $financiamiento = Financiamiento::findOrFail($idFinanciamiento);
        Log::info('Financiamiento encontrado');

        // Validar si hay cuotas seleccionadas
        if (empty($cuotasSeleccionadas)) {
            Log::warning('No se seleccionaron cuotas para pagar');
            return redirect()->route('pago.index')->with('error', 'No se seleccionaron cuotas para pagar.');
        }

        $cuotasSeleccionadas = array_map('intval', $cuotasSeleccionadas);


        // Obtener todas las cuotas seleccionadas en una sola consulta
        $pagos = Pago::where('id_financiamiento', $idFinanciamiento)
        ->whereIn('cuota', $cuotasSeleccionadas)
        ->get();
    
        Log::info('Consulta de pagos ejecutada', ['query' => $pagos]);
    

        if ($pagos->isEmpty()) {
            Log::warning('No se encontraron las cuotas seleccionadas');
            return redirect()->route('pago.index')->with('error', 'No se encontraron las cuotas seleccionadas.');
        }

        // Actualizar estado de las cuotas y calcular monto descontado
        $montoDescontado = 0;
        foreach ($pagos as $pago) {
            $pago->update(['estado' => 'Cancelado']);
            $montoDescontado += $montoCuota;
        }

        Log::info('Estado de cuotas actualizado');

        // Actualizar monto pendiente del financiamiento
        $financiamiento->montoPendiente = max(0, $financiamiento->montoPendiente - $montoDescontado);
        $financiamiento->save();

        Log::info('Monto pendiente actualizado', ['montoPendiente' => $financiamiento->montoPendiente]);

        // Crear detalle de pago
        $detallePago = DetallePago::create([
            'id_pago' => $pagos->last()->id_pago,
            'fechaPago' => $fechaPago,
            'montoCuota' => $montoCuota,
            'montoPorMora' => $montoPorMora,
            'moraAplicada' => $moraAplicada,
            'montoTotal' => $montoTotal,
            'metodo_pago' => $metodo_pago,
            'numero_cuenta' => $numero_cuenta,
            'descripcion' => "Pago de cuotas: " . implode(", ", $cuotasSeleccionadas),
        ]);

        Log::info('Detalle de pago creado', ['detallePago' => $detallePago->id_detalle_pago]);

        // dd($detallePago);

        // Generar PDF
        $cliente = $financiamiento->cliente;
        $propiedad = $financiamiento->propiedad;

        $data = [
            'cliente' => $cliente,
            'financiamiento' => $financiamiento,
            'pago' => $pago,
            'propiedad' => $propiedad,
            'detallePago' => $detallePago
        ];

        Log::info('Generando factura PDF');

       // dd($data);

        $pdf = PDF::loadView('pdf.factura', $data);
        $pdfDirectory = storage_path('app/public/facturas/');
        if (!file_exists($pdfDirectory)) {
            mkdir($pdfDirectory, 0755, true);
        }

        $pdfPath = $pdfDirectory . 'factura_' . $detallePago->id_detalle_pago . '.pdf';
        $pdf->save($pdfPath);


        Log::info('Factura PDF generada', ['pdfPath' => $pdfPath]);

        // Enviar correo con la factura
         Mail::to($cliente->email)->send(new \App\Mail\cobroMail($pdfPath, $data));

        // Commit a la transacción
        DB::commit();
        Log::info('Pago realizado exitosamente');

        return redirect()->route('pago.index')->with('success', 'Pago realizado exitosamente.');

    } catch (\Throwable $th) {
        DB::rollBack();
        Log::error('Error al realizar el pago: ' . $th->getMessage());
        // dd($th->getMessage()); // Debug para ver el error en pantalla
        return redirect()->route('pago.index')->with('error', 'Sucedió un error al realizar el pago.');
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // Buscar el pago por su ID, cargando las relaciones correctamente
            $pago = Pago::with('detallePagos', 'financiamiento.cliente')->findOrFail($id);
            
            // Cargar la vista de edición con los datos del pago
            return view('pagos.edit', compact('pago'));
        } catch (\Exception $e) {
            Log::error('Error al cargar la página de edición: ' . $e->getMessage());
            return redirect()->route('pago.index')->with('error', 'Error al cargar la página de edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $pago = Pago::findOrFail($id);
            
            foreach ($request->input('montoPago') as $index => $montoPago) {
                $detallePago = $pago->detallePagos[$index];
                $detallePago->update([
                    'montoPago' => $montoPago,
                    'fechaPago' => $request->input('fechaPago')[$index],
                    'monto_mora' => $request->input('montoMora')[$index],
                    'descripcion' => $request->input('descripcion')[$index],
                ]);
            }
    
            DB::commit();
            return redirect()->route('pago.index')->with('success', 'Pago actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el pago: ' . $e->getMessage());
            return redirect()->route('pago.index')->with('error', 'Error al actualizar el pago.');
        }
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


    public function downloadFactura(string $id_pago)
    {
    try {
        $filePath = storage_path('app/public/facturas/') . 'factura_' . $id_pago . '.pdf';

        if (!file_exists($filePath)) {
            return redirect()->route('pago.index')->with('error', 'Factura no encontrada.');
        }

        return response()->download($filePath);
        } catch (\Exception $e) {
            Log::error('Error al descargar la factura: ' . $e->getMessage());
            return redirect()->route('pago.index')->with('error', 'Error al descargar la factura.');
        }
    }


}
