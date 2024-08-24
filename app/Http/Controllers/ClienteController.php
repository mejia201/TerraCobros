<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Informacion_laboral;
use App\Models\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{

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


    public function create()
    {
        try {
            return view('cliente.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cliente.index')->with('error', 'Error al cargar la página para agregar un cliente');
        }
    }

 
    public function store(Request $request)
    {
     

        try {

            // Define las reglas de validación
            $rules = [
                'nombre' => 'required',
                'dui' => 'required|unique:cliente,dui',
                'telefono' => 'required|regex:/^\d{4}-\d{4}$/|unique:cliente,telefono',
                'email' => 'required|email|unique:cliente,email',
                'tipo_cliente' => 'required',
                'fecha_nacimiento'=> 'required',
                'edad'=> 'required',
                'sexo'=> 'required',
                'referencias' => 'required|array',
                'referencias.*.tipo' => 'required|string',
                'referencias.*.nombre' => 'required|string',
                'referencias.*.direccion' => 'required|string',
            ];
    
            $messages = [
                'nombre.required' => 'El nombre es obligatorio.',
                'dui.required' => 'El campo "DUI" es obligatorio.',
                'dui.unique' => 'El DUI ingresado ya está registrado, intenta de nuevo.',
                'telefono.required' => 'El campo "Teléfono" es obligatorio.',
                'telefono.unique' => 'Este teléfono ya está registrado, intenta de nuevo.',
                'telefono.regex' => 'El campo "Teléfono" debe tener el formato correcto (por ejemplo, 7889-1256).',
                'email.required' => 'El correo es requerido.',
                'email.unique' => 'El correo ya está registrado, intenta de nuevo.',
                'email.email' => 'El campo "Correo" debe ser una dirección de correo electrónico válida.',
                
                'tipo_cliente.required' => 'El campo "Tipo de Cliente" es obligatorio.',              
                'fecha_nacimiento.required' => 'El campo "Fecha de Nacimiento" es obligatorio.',
                'edad.required' => 'El campo "Edad" es obligatorio.',
                'sexo.required' => 'El campo "Sexo" es obligatorio.',

                'referencias.*.tipo.required' => 'El tipo de referencia es obligatorio.',
                'referencias.*.nombre.required' => 'El nombre de la referencia es obligatorio.',
                'referencias.*.direccion.required' => 'La dirección de la referencia es obligatoria.',

            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                    ->route('cliente.create')
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Creación del cliente
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->dui = $request->input('dui');
            $cliente->telefono = $request->input('telefono');
            $cliente->email = $request->input('email');
            $cliente->direccion = $request->input('direccion');
            $cliente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $cliente->sexo = $request->input('sexo');
            $cliente->edad = $request->input('edad');
            $cliente->estado_civil = $request->input('estado_civil');
            $cliente->nacionalidad = $request->input('nacionalidad');
            $cliente->pais_nacimiento = $request->input('pais_nacimiento');
            $cliente->estatus = $request->input('estatus');
            $cliente->medio_enterado = $request->input('medio_enterado');
            $cliente->tipo_cliente = $request->input('tipo_cliente');
            $cliente->valor_reserva = $request->input('valor_reserva');
            $cliente->fecha_reserva = $request->input('fecha_reserva');
            $cliente->precio_venta = $request->input('precio_venta');
            $cliente->prima = $request->input('prima');
            $cliente->valor_financiado = $request->input('valor_financiado');
            $cliente->save();


            // Creación de la información laboral
            $informacionLaboral = new Informacion_laboral();
            $informacionLaboral->id_cliente = $cliente->id_cliente;
            $informacionLaboral->estado_laboral = $request->input('estado_laboral');
            $informacionLaboral->nombre_empresa = $request->input('nombre_empresa');
            $informacionLaboral->direccion_empresa = $request->input('direccion_empresa');
            $informacionLaboral->cargo = $request->input('cargo');
            $informacionLaboral->telefono_empresa = $request->input('telefono_empresa');
            $informacionLaboral->tiempo_en_empresa = $request->input('tiempo_en_empresa');
            $informacionLaboral->jefe_inmediato = $request->input('jefe_inmediato');
            $informacionLaboral->telefono_jefe = $request->input('telefono_jefe');
            $informacionLaboral->registro_iva = $request->input('registro_iva');
            $informacionLaboral->tipo_negocio = $request->input('tipo_negocio');
            $informacionLaboral->salario_mensual = $request->input('salario_mensual');
            $informacionLaboral->ingresos_adicionales = $request->input('ingresos_adicionales');
            $informacionLaboral->remesas = $request->input('remesas');
            $informacionLaboral->save();


            $referencias = $request->input('referencias');
            foreach ($referencias as $referenciaData) {
                $referencia = new Referencia();
                $referencia->id_cliente = $cliente->id_cliente;
                $referencia->tipo = $referenciaData['tipo'];
                $referencia->nombre = $referenciaData['nombre'];
                $referencia->direccion = $referenciaData['direccion'];
                $referencia->telefono = $referenciaData['telefono'];
                $referencia->save();
            }

            
            return redirect()->route('cliente.index')->with('success', 'El registro del cliente se ha agregado con éxito.');
    
        } catch (\Throwable $th) {
            Log::error('Error al agregar el cliente: ' . $th->getMessage());
            return redirect()->route('cliente.index')->with('error', 'Sucedió un error al ingresar el cliente.');
        }
    }

  


    public function edit($id)
    {
        try {

            $cliente = Cliente::find($id);
    
            // Verifica si el registro existe
            if (!$cliente) {
                return redirect()->back()->with('error', 'Ha ocurrido un error. No se pudo realizar la operación.');
            }
    
            return view('cliente.edit', compact('cliente'));
    

    
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect()->route('clientes')->with('error', 'Error al cargar la página para editar la informacion del cliente');
            }
    }


    public function update(Request $request, $id)
    {
        try {

           

            $rules = [
                'nombre' => 'required',
                'dui' => 'required|unique:cliente,dui,' . $id . ',id_cliente',
                'telefono' => 'required|regex:/^\d{4}-\d{4}$/|unique:cliente,telefono,' . $id . ',id_cliente',
                'email' => 'required|email|unique:cliente,email,' . $id . ',id_cliente',
                'tipo_cliente' => 'required',
                'fecha_nacimiento'=> 'required',
                'edad'=> 'required',
                'sexo'=> 'required',
                'referencias' => 'required|array',
                'referencias.*.tipo' => 'required|string',
                'referencias.*.nombre' => 'required|string',
                'referencias.*.direccion' => 'required|string',
            ];
            
        
            $messages = [
                'nombre.required' => 'El nombre es obligatorio.',
                'dui.required' => 'El campo "DUI" es obligatorio.',
                'dui.unique' => 'El DUI ingresado ya está registrado, intenta de nuevo.',
                'telefono.required' => 'El campo "Teléfono" es obligatorio.',
                'telefono.unique' => 'Este teléfono ya está registrado, intenta de nuevo.',
                'telefono.regex' => 'El campo "Teléfono" debe tener el formato correcto (por ejemplo, 7889-1256).',
                'email.required' => 'El correo es requerido.',
                'email.unique' => 'El correo ya está registrado, intenta de nuevo.',
                'email.email' => 'El campo "Correo" debe ser una dirección de correo electrónico válida.',
                'tipo_cliente.required' => 'El campo "Tipo de Cliente" es obligatorio.',              
                'fecha_nacimiento.required' => 'El campo "Fecha de Nacimiento" es obligatorio.',
                'edad.required' => 'El campo "Edad" es obligatorio.',
                'sexo.required' => 'El campo "Sexo" es obligatorio.',
                'referencias.*.tipo.required' => 'El tipo de referencia es obligatorio.',
                'referencias.*.nombre.required' => 'El nombre de la referencia es obligatorio.',
                'referencias.*.direccion.required' => 'La dirección de la referencia es obligatoria.',
            ];
        
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if ($validator->fails()) {
                return redirect()
                    ->route('cliente.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        
            
            $cliente = Cliente::findOrFail($id);
            $cliente->nombre = $request->input('nombre');
            $cliente->dui = $request->input('dui');
            $cliente->telefono = $request->input('telefono');
            $cliente->email = $request->input('email');
            $cliente->direccion = $request->input('direccion');
            $cliente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $cliente->sexo = $request->input('sexo');
            $cliente->edad = $request->input('edad');
            $cliente->estado_civil = $request->input('estado_civil');
            $cliente->nacionalidad = $request->input('nacionalidad');
            $cliente->pais_nacimiento = $request->input('pais_nacimiento');
            $cliente->estatus = $request->input('estatus');
            $cliente->medio_enterado = $request->input('medio_enterado');
            $cliente->tipo_cliente = $request->input('tipo_cliente');
            $cliente->valor_reserva = $request->input('valor_reserva');
            $cliente->fecha_reserva = $request->input('fecha_reserva');
            $cliente->precio_venta = $request->input('precio_venta');
            $cliente->prima = $request->input('prima');
            $cliente->valor_financiado = $request->input('valor_financiado');
            $cliente->save();
    
            // Actualizar la información laboral
            $informacionLaboral = Informacion_laboral::where('id_cliente', $id)->first();
            if ($informacionLaboral) {
                $informacionLaboral->estado_laboral = $request->input('estado_laboral');
                $informacionLaboral->nombre_empresa = $request->input('nombre_empresa');
                $informacionLaboral->direccion_empresa = $request->input('direccion_empresa');
                $informacionLaboral->cargo = $request->input('cargo');
                $informacionLaboral->telefono_empresa = $request->input('telefono_empresa');
                $informacionLaboral->tiempo_en_empresa = $request->input('tiempo_en_empresa');
                $informacionLaboral->jefe_inmediato = $request->input('jefe_inmediato');
                $informacionLaboral->telefono_jefe = $request->input('telefono_jefe');
                $informacionLaboral->registro_iva = $request->input('registro_iva');
                $informacionLaboral->tipo_negocio = $request->input('tipo_negocio');
                $informacionLaboral->salario_mensual = $request->input('salario_mensual');
                $informacionLaboral->ingresos_adicionales = $request->input('ingresos_adicionales');
                $informacionLaboral->remesas = $request->input('remesas');
                $informacionLaboral->save();
            }
    
            // Actualizar las referencias
            Referencia::where('id_cliente', $id)->delete();
            $referencias = $request->input('referencias');
            foreach ($referencias as $referenciaData) {
                $referencia = new Referencia();
                $referencia->id_cliente = $id;
                $referencia->tipo = $referenciaData['tipo'];
                $referencia->nombre = $referenciaData['nombre'];
                $referencia->direccion = $referenciaData['direccion'];
                $referencia->telefono = $referenciaData['telefono'];
                $referencia->save();
            }
    
            return redirect()->route('cliente.index')->with('success', 'El registro del cliente se ha actualizado con éxito.');
        
        } catch (\Throwable $th) {
            Log::error('Error al actualizar el cliente: ' . $th->getMessage());
            return redirect()->route('cliente.index')->with('error', 'Sucedió un error al actualizar el cliente.');
        }
    }

    public function destroy($id)
    {
        try {
            // Buscar cliente por su ID
            $cliente = Cliente::findOrFail($id);
            
            $cliente->delete();
            
           
            return redirect()->route('cliente.index')->with('success', 'El registro del cliente se elimino exitosamente.');
    
        } catch (\Exception $e) {
            Log::error('Error al eliminar el cliente: ' . $e->getMessage());
                return redirect()->route('cliente.index')->with('error', 'Sucedió un error al intentar eliminar el registro del cliente.');
        }
    }
}
