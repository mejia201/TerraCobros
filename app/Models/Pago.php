<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $primaryKey = 'id_pago';


    protected $fillable = [
        'id_financiamiento',
        'fechaPagoEsperada',
        'montoPago',
        'cuota',
        'estado'
    ];

    public function financiamiento()
    {
        return $this->belongsTo(Financiamiento::class, 'id_financiamiento');
    }

    public function getDescripcionAttribute()
    {
       
        return $this->financiamiento->descripcion . ' - Fecha de Pago: ' . $this->fechaPago->format('d-m-Y');
    }


    public function detallePagos()
    {
        return $this->hasMany(DetallePago::class, 'id_pago', 'id_pago');
    }

}
