<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regalo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'ruta_imagen',
        'esta_disponible',
    ];

    public function seleccionados()
    {
        return $this->hasMany(RegaloSeleccionado::class);
    }

}
