<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedad';
    protected $primaryKey = 'id_propiedad';

    protected $fillable = [
        'areaTerreno',
        'precioPorVRS',
        'precioTotal',
        'primaEnEfectivo',
        'montoAFinanciar',
        'ingresoRequerido',
    ];

    public function financiamientos()
    {
        return $this->hasMany(Financiamiento::class, 'id_propiedad');
    }
    
}
