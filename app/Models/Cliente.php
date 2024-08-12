<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'nombre',
        'dui',
        'telefono',
        'email',
    ];

    public function financiamientos()
    {
        return $this->hasMany(Financiamiento::class, 'id_cliente');
    }
    
}
