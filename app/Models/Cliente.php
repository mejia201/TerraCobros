<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre',
        'dui',
        'telefono',
        'email',
        'direccion',
        'fecha_nacimiento',
        'sexo',
        'edad',
        'estado_civil',
        'nacionalidad',
        'pais_nacimiento',
        'estatus',
        'medio_enterado',
        'tipo_cliente',
        'fecha_reserva',
        'valor_reserva',
        'precio_venta',
        'prima',
        'valor_financiado',
    ];

    public function financiamientos()
    {
        return $this->hasMany(Financiamiento::class, 'id_cliente');
    }

   
    public function informacionLaboral()
    {
        return $this->hasOne(Informacion_laboral::class, 'id_cliente');
    }

  
    public function referencias()
    {
        return $this->hasMany(Referencia::class, 'id_cliente');
    }

}
