<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $primaryKey = 'id_pago';
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id_financiamiento',
        'fechaPago',
        'montoPago',
        'fechaPagoEsperada',
    ];

    public function financiamiento()
    {
        return $this->belongsTo(Financiamiento::class, 'id_financiamiento');
    }

}
