<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacion_laboral extends Model
{
    use HasFactory;

    protected $table = 'informacion_laboral';
    protected $primaryKey = 'id_informacion_laboral';

    protected $fillable = [
        'id_cliente',
        'estado_laboral',
        'nombre_empresa',
        'direccion_empresa',
        'cargo',
        'telefono_empresa',
        'tiempo_en_empresa',
        'jefe_inmediato',
        'telefono_jefe',
        'registro_iva',
        'tipo_negocio',
        'salario_mensual',
        'ingresos_adicionales',
        'remesas',
    ];


    // Relación inversa con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
