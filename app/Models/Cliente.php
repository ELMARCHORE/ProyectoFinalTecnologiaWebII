<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'correo', 'celular', 'nombre', 'apellidos', 'tdocumento', 'documento', 'direccion', 'tdatos'
    ];

    // Define otras relaciones si es necesario
}
