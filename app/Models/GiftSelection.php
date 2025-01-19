<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftSelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gift_id',
        'payment_method',
        'payment_proof_url'
    ];

    /**
     * Relación: Una selección de regalo pertenece a un usuario.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una selección de regalo pertenece a un regalo.
     */
    public function gift(){
        return $this->belongsTo(Gift::class);
    }
}
