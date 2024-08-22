<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{

    protected $table = 'proyecto';

    protected $fillable = [
        'nombre_proyecto',
    ];

    use HasFactory;
}
