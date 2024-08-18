<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financiamiento extends Model
{
    use HasFactory;

    protected $table = 'financiamiento';
    protected $primaryKey = 'id_financiamiento';


    protected $fillable = [
        'id_propiedad',
        'id_cliente',
        'tasaInteres',
        'plazoAnos',
        'pagoMensual',
        'numeroCuotas',
        'fechaInicio',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_financiamiento');
    }


     
     public function getDescripcionAttribute()
     {
         return $this->cliente->nombre . ' - ' . ' (Pago Mensual: $' . $this->pagoMensual . ')';
     }
}
