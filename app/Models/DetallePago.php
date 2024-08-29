<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    use HasFactory;

    protected $table = 'detalle_pago';
    protected $primaryKey = 'id_detalle_pago';

    protected $fillable = [
        'id_pago',
        'fechaPago',
        'montoPago',
        'monto_mora',
        'monto_total',
        'descripcion',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pago');
    }
}
