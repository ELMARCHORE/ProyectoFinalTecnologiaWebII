<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleComprobante extends Model
{
    use HasFactory;

    protected $fillable = [
        'comprobante_id', 'cantidad', 'descripcion', 'punitario', 'importe'
    ];

    // Define otras relaciones si es necesario
}
