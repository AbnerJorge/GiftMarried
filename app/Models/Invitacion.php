<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'asistira',
        'llevara_pareja',
        'respondido_en',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

}
