<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegaloSeleccionado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'regalo_id',
        'seleccionado_en',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function regalo()
    {
        return $this->belongsTo(Regalo::class);
    }

    public function pago()
    {
        return $this->hasOne(Pago::class);
    }
}
