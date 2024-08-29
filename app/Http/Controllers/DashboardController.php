<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        try{

          // Obtener la fecha actual
          $hoy = Carbon::today();

          // Obtener pagos próximos a vencer (dentro de los próximos 7 días)
          $proximosPagos = Pago::where('fechaPagoEsperada', '>=', $hoy)
                                ->where('fechaPagoEsperada', '<=', $hoy->copy()->addDays(7))
                                ->where('estado', '!=', 'Cancelado')
                                ->get();
                                
          // Obtener pagos vencidos
          $pagosVencidos = Pago::where('fechaPagoEsperada', '<', $hoy)
                               ->where('estado', '!=', 'Cancelado')
                               ->get();
  
          return view('dashboard', compact('proximosPagos', 'pagosVencidos'));

        } catch (\Throwable $th) {
            Log::error('Error al cargar las fechas esperadas en el dashboard: ' . $th->getMessage());
        }
         
    }


}
