<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Financiamiento;
use App\Models\Pago;
use App\Models\Propiedad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            $propiedades = Propiedad::where('estado', 'D')->get(); 



            return view('financiamiento.create', compact('clientes', 'propiedades'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('financiamiento.index')->with('error', 'Error al cargar la página para agregar un financiamiento');
        }
    }


    public function obtenerOpcionesFinanciamiento(Request $request)
    {
        $propiedad = Propiedad::find($request->id_propiedad);
        $montoAFinanciar = $propiedad->montoAFinanciar;
        $tasaInteresAnual = 12;
        $tasaInteresMensual = $tasaInteresAnual / 12 / 100;

        $opciones = [];

        for ($plazoAnos = 1; $plazoAnos <= 7; $plazoAnos++) {
            $numeroCuotas = $plazoAnos * 12;
            $pagoMensual = ($montoAFinanciar * $tasaInteresMensual) / (1 - pow((1 + $tasaInteresMensual), -$numeroCuotas));

            $opciones[] = [
                'plazoAnos' => $plazoAnos,
                'pagoMensual' => round($pagoMensual, 2),
                'numeroCuotas' => $numeroCuotas,
                'tasaInteres' => $tasaInteresAnual
            ];
        }

        return response()->json($opciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validación
            $rules = [
                'id_cliente' => 'required|exists:cliente,id_cliente',
                'id_propiedad' => 'required|exists:propiedad,id_propiedad',
                'tasaInteres' => 'required|numeric|min:0',
                'plazoAnos' => 'required|integer|min:1',
                'pagoMensual' => 'required|numeric|min:0',
                'numeroCuotas' => 'required|integer|min:1',
                'fechaInicio' => 'required|date',
            ];
            
            $messages = [
                'id_cliente.required' => 'El cliente es obligatorio.',
                'id_cliente.exists' => 'El cliente seleccionado no existe.',
                'id_propiedad.required' => 'La propiedad es obligatoria.',
                'id_propiedad.exists' => 'La propiedad seleccionada no existe.',
                'tasaInteres.required' => 'La tasa de interés es obligatoria.',
                'tasaInteres.numeric' => 'La tasa de interés debe ser un número.',
                'plazoAnos.required' => 'El plazo en años es obligatorio.',
                'plazoAnos.integer' => 'El plazo en años debe ser un número entero.',
                'pagoMensual.required' => 'El pago mensual es obligatorio.',
                'pagoMensual.numeric' => 'El pago mensual debe ser un número.',
                'numeroCuotas.required' => 'El número de cuotas es obligatorio.',
                'numeroCuotas.integer' => 'El número de cuotas debe ser un número entero.',
                'fechaInicio.required' => 'La fecha de inicio es obligatoria.',
                'fechaInicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if ($validator->fails()) {
                return redirect()
                    ->route('financiamiento.create')
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Obtención de datos del formulario
            $idCliente = $request->input('id_cliente');
            $idPropiedad = $request->input('id_propiedad');
            $tasaInteres = $request->input('tasaInteres');
            $plazoAnos = $request->input('plazoAnos');
            $pagoMensual = $request->input('pagoMensual');
            $numeroCuotas = $request->input('numeroCuotas');
            $fechaInicio = $request->input('fechaInicio');

            // Obtener la propiedad para obtener el monto a financiar
        $propiedad = Propiedad::find($request->input('id_propiedad'));
        if (!$propiedad) {
            return redirect()->route('financiamiento.index')
                ->with('error', 'La propiedad seleccionada no existe.')
                ->withInput();
        }

        $montoAFinanciar = $propiedad->montoAFinanciar;
    
            // Creación de la instancia de Financiamiento
            $financiamiento = new Financiamiento();
            $financiamiento->id_cliente = $idCliente;
            $financiamiento->id_propiedad = $idPropiedad;
            $financiamiento->tasaInteres = $tasaInteres;
            $financiamiento->plazoAnos = $plazoAnos;
            $financiamiento->pagoMensual = $pagoMensual;
            $financiamiento->numeroCuotas = $numeroCuotas;
            $financiamiento->fechaInicio = $fechaInicio;
            $financiamiento->seleccionado = true;
            $financiamiento->montoPendiente = $montoAFinanciar;
            $financiamiento->save();

            $propiedad = Propiedad::find($idPropiedad);
            $propiedad->estado = 'R';
            $propiedad->save();


            // Generar las fechas de pago esperadas
            $numeroCuotas = $request->input('numeroCuotas');
            $fechaInicio = Carbon::parse($request->input('fechaInicio'));
            $montoMensual = $request->input('pagoMensual');

            for ($i = 1; $i <= $numeroCuotas; $i++) {
                // Calcula la fecha del pago con base en la fecha de inicio y el número de cuota
                $fechaPagoEsperada = $fechaInicio->copy()->addMonths($i);

                Pago::create([
                    'id_financiamiento' => $financiamiento->id_financiamiento,
                    'fechaPagoEsperada' => $fechaPagoEsperada,
                    'montoPago' => $montoMensual,
                    'cuota' => $i,
                    'estado' => 'Pendiente',
                ]);
            }

            
            return redirect()->route('financiamiento.index')->with('success', 'Financiamiento registrado exitosamente.');
    
        } catch (\Throwable $th) {
            Log::error('Error al guardar el financiamiento: ' . $th->getMessage());
            return redirect()->route('financiamiento.index')->with('error', 'Sucedió un error al ingresar el financiamiento.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $financiamiento = Financiamiento::find($id);
    
            // Verifica si el registro existe
            if (!$financiamiento) {
                return redirect()->back()->with('error', 'Ha ocurrido un error. No se pudo realizar la operación.');
            }
    
            $clientes = Cliente::all(); 
            $propiedades = Propiedad::all();
    
            
            return view('financiamiento.edit', compact('financiamiento', 'clientes', 'propiedades'));
    
    

    
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect()->route('financiamientos')->with('error', 'Error al cargar la página para editar el financiamiento');
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validación
            $rules = [
                'id_cliente' => 'required|exists:cliente,id_cliente',
                'id_propiedad' => 'required|exists:propiedad,id_propiedad',
                'tasaInteres' => 'required|numeric|min:0',
                'plazoAnos' => 'required|integer|min:1',
                'pagoMensual' => 'required|numeric|min:0',
                'numeroCuotas' => 'required|integer|min:1',
                'fechaInicio' => 'required|date',
            ];
            
            $messages = [
                'id_cliente.required' => 'El cliente es obligatorio.',
                'id_cliente.exists' => 'El cliente seleccionado no existe.',
                'id_propiedad.required' => 'La propiedad es obligatoria.',
                'id_propiedad.exists' => 'La propiedad seleccionada no existe.',
                'tasaInteres.required' => 'La tasa de interés es obligatoria.',
                'tasaInteres.numeric' => 'La tasa de interés debe ser un número.',
                'plazoAnos.required' => 'El plazo en años es obligatorio.',
                'plazoAnos.integer' => 'El plazo en años debe ser un número entero.',
                'pagoMensual.required' => 'El pago mensual es obligatorio.',
                'pagoMensual.numeric' => 'El pago mensual debe ser un número.',
                'numeroCuotas.required' => 'El número de cuotas es obligatorio.',
                'numeroCuotas.integer' => 'El número de cuotas debe ser un número entero.',
                'fechaInicio.required' => 'La fecha de inicio es obligatoria.',
                'fechaInicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if ($validator->fails()) {
                return redirect()
                    ->route('financiamiento.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Obtener el financiamiento existente
            $financiamiento = Financiamiento::find($id);
            if (!$financiamiento) {
                return redirect()->route('financiamiento.index')->with('error', 'El financiamiento no existe.');
            }
    
            // Validar si se está seleccionando una propiedad diferente con estado 'R'
            if ($request->input('id_propiedad') != $financiamiento->id_propiedad) {
                $propiedad = Propiedad::find($request->input('id_propiedad'));
                if ($propiedad->estado === 'R') {
                    return redirect()
                        ->route('financiamiento.index', $id)
                        ->with('error', 'La propiedad seleccionada ya está reservada. Por favor, elige otra propiedad.')
                        ->withInput();
                }

                   // Actualizar el estado de la nueva propiedad a 'R' si se ha cambiado
                $propiedad->estado = 'R';
                $propiedad->save();
            }
    
            // Actualizar los datos del financiamiento
            $financiamiento->id_cliente = $request->input('id_cliente');
            $financiamiento->id_propiedad = $request->input('id_propiedad');
            $financiamiento->tasaInteres = $request->input('tasaInteres');
            $financiamiento->plazoAnos = $request->input('plazoAnos');
            $financiamiento->pagoMensual = $request->input('pagoMensual');
            $financiamiento->numeroCuotas = $request->input('numeroCuotas');
            $financiamiento->fechaInicio = $request->input('fechaInicio');
            $financiamiento->save();
    
      
            return redirect()->route('financiamiento.index')->with('success', 'Financiamiento actualizado exitosamente.');
    
        } catch (\Throwable $th) {
            Log::error('Error al actualizar el financiamiento: ' . $th->getMessage());
            return redirect()->route('financiamiento.index')->with('error', 'Sucedió un error al actualizar el financiamiento.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Buscar financiamiento por su ID
            $financiamiento = Financiamiento::findOrFail($id);
            
            $financiamiento->delete();
            
           
            return redirect()->route('financiamiento.index')->with('success', 'El registro del financiamiento se elimino exitosamente.');
    
        } catch (\Exception $e) {
            Log::error('Error al eliminar el financiamiento: ' . $e->getMessage());
                return redirect()->route('financiamiento.index')->with('error', 'Sucedió un error al intentar eliminar el registro del financiamiento.');
        }
    }
}
