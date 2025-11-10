<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos'; 
    public $timestamps = false; 

    protected $fillable = [
        'usuario_id',
        'tipo',
        'monto',
        'fecha',
        'factura_url',
        'descripcion',
        // 'fecha_registro' se llena sola
    ];
}