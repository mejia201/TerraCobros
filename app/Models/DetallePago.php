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
        'fecha_pago',
        'monto_pagado',
        'monto_mora',
        'monto_total',
    ];

    /**
     * Relación con el modelo `Pago`.
     */
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pago', 'id_pago');
    }



    /**
     * Cálculo de la mora basado en la fecha de pago.
     */
    public function calcularMora($tasaMora, $fechaEsperada)
    {
        $diferenciaDias = $this->fecha_pago->diffInDays($fechaEsperada);

        if ($diferenciaDias > 0) {
            $this->monto_mora = $this->monto_pagado * ($tasaMora / 100) * $diferenciaDias;
            $this->monto_total = $this->monto_pagado + $this->monto_mora;
        } else {
            $this->monto_mora = 0;
            $this->monto_total = $this->monto_pagado;
        }

        $this->save();
    }

}
