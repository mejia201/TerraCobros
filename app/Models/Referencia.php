<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $table = 'referencias';
    protected $primaryKey = 'id_referencia';

    protected $fillable = [
        'id_cliente',
        'tipo',
        'nombre',
        'direccion',
        'telefono',
    ];

   
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

}
