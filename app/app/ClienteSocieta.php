<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteSocieta extends Model
{
    protected $table = 'cliente_societa';

    public $timestamps = true;

    protected $fillable = [
        'cliente_id',
        'societa_id',
        'idGamma',
        'ID_AGENTE_GAMMA',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function societa()
    {
        return $this->belongsTo(Societa::class);
    }
}
