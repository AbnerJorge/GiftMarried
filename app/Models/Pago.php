<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'regalo_seleccionado_id',
        'metodo_pago',
        'monto',
        'comprobante_pago',
        'esta_verificado',
        'pagado_en',
    ];

    public function regaloSeleccionado()
    {
        return $this->belongsTo(RegaloSeleccionado::class);
    }
}
