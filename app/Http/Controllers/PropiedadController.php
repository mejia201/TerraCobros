<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        try {
            // Definición del porcentaje de la prima
            $porcentajePrima = 0.15;
    
            // Validación
            $rules = [
                'area_terreno' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/',
                'precio_vrs' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/',
            ];
            
            $messages = [
                'area_terreno.required' => 'El área del terreno es obligatorio.',
                'area_terreno.regex' => 'El formato del área del terreno no es válido.',
                'precio_vrs.required' => 'El precio por VRS² es obligatorio.',
                'precio_vrs.regex' => 'El formato del precio por VRS² no es válido.',
            ];
            
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                    ->route('propiedad.create')
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Cálculos
            // $areaTerreno = $request->input('area_terreno');
            // $precioPorVRS = $request->input('precio_vrs');

            $areaTerreno = str_replace(',', '', $request->input('area_terreno'));
            $precioPorVRS = str_replace(',', '', $request->input('precio_vrs'));
            
            $precioTotal = $areaTerreno * $precioPorVRS;
            $primaEnEfectivo = $precioTotal * $porcentajePrima;
            $montoAFinanciar = $precioTotal - $primaEnEfectivo;
            $ingresoRequerido = $precioTotal / 30;  // Cálculo del ingreso requerido
    
            // Creación de la propiedad
            $propiedad = new Propiedad();
            $propiedad->areaTerreno = $areaTerreno;
            $propiedad->precioPorVRS = $precioPorVRS;
            $propiedad->precioTotal = $precioTotal;
            $propiedad->primaEnEfectivo = $primaEnEfectivo;
            $propiedad->montoAFinanciar = $montoAFinanciar;
            $propiedad->ingresoRequerido = $ingresoRequerido;
            $propiedad->estado = $request->input('estado');
            $propiedad->save();
    
            return redirect()->route('propiedad.index')->with('success', 'Propiedad registrada exitosamente.');
    
        } catch (\Throwable $th) {
            Log::error('Error al guardar la propiedad: ' . $th->getMessage());
            return redirect()->route('propiedad.index')->with('error', 'Sucedió un error al ingresar la propiedad.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $propiedad = Propiedad::find($id);
    
            // Verifica si el registro existe
            if (!$propiedad) {
                return redirect()->back()->with('error', 'Ha ocurrido un error. No se pudo realizar la operación.');
            }
    
            return view('propiedad.edit', compact('propiedad'));
    

    
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect()->route('clientes')->with('error', 'Error al cargar la página para editar la propiedad');
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Definición del porcentaje de la prima
            $porcentajePrima = 0.15;
    
            // Validación
            $rules = [
                'area_terreno' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/',
                'precio_vrs' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/',
            ];
            
            $messages = [
                'area_terreno.required' => 'El área del terreno es obligatoria.',
                'area_terreno.regex' => 'El formato del área del terreno no es válido.',
                'precio_vrs.required' => 'El precio por VRS² es obligatorio.',
                'precio_vrs.regex' => 'El formato del precio por VRS² no es válido.',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                    ->route('propiedad.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Cálculos
            $areaTerreno = str_replace(',', '', $request->input('area_terreno'));
            $precioPorVRS = str_replace(',', '', $request->input('precio_vrs'));
    
            $precioTotal = $areaTerreno * $precioPorVRS;
            $primaEnEfectivo = $precioTotal * $porcentajePrima;
            $montoAFinanciar = $precioTotal - $primaEnEfectivo;
            $ingresoRequerido = $precioTotal / 30;  // Cálculo del ingreso requerido
    
            // Actualización de la propiedad
            $propiedad = Propiedad::find($id);
    
            if (!$propiedad) {
                return redirect()->back()->with('error', 'Ha ocurrido un error. No se pudo realizar la operación.');
            }
    
            $propiedad->areaTerreno = $areaTerreno;
            $propiedad->precioPorVRS = $precioPorVRS;
            $propiedad->precioTotal = $precioTotal;
            $propiedad->primaEnEfectivo = $primaEnEfectivo;
            $propiedad->montoAFinanciar = $montoAFinanciar;
            $propiedad->ingresoRequerido = $ingresoRequerido;
            $propiedad->estado = $request->input('estado');
            $propiedad->save();
    
            return redirect()->route('propiedad.index')->with('success', 'Propiedad actualizada exitosamente.');
    
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $th) {
            Log::error('Error al actualizar la propiedad: ' . $th->getMessage());
            return redirect()->route('propiedad.index')->with('error', 'Sucedió un error al actualizar la propiedad.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Buscar la propiedad por su ID
            $propiedad = Propiedad::findOrFail($id);
            
            $propiedad->delete();
            
           
            return redirect()->route('propiedad.index')->with('success', 'Propiedad eliminada exitosamente.');
    
        } catch (\Exception $e) {
            Log::error('Error al eliminar la propiedad: ' . $e->getMessage());
                return redirect()->route('propiedad.index')->with('error', 'Sucedió un error al intentar eliminar la propiedad.');
        }
    }
}
