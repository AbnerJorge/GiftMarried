<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'contenido',
        'enviado_en',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
