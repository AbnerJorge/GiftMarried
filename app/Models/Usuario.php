<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'correo',
        'password',
        'es_admin'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function invitacion()
    {
        return $this->hasOne(Invitacion::class);
    }

    public function regaloSeleccionado()
    {
        return $this->hasOne(RegaloSeleccionado::class);
    }

    public function mensaje()
    {
        return $this->hasOne(Mensaje::class);
    }

}
