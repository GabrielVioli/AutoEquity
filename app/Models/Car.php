<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'fipe_codigo',
        'marca',
        'modelo',
        'ano_modelo',
        'combustivel',
        'valor',
        'mes_referencia',
        'sigla_combustivel'
    ];
}
