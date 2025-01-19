<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'is_available',
    ];

    /**
     * Relación: Un regalo puede tener una selección de regalo.
     */
    public function giftSelection(){
        return $this->hasOne(GiftSelection::class);
    }
}
