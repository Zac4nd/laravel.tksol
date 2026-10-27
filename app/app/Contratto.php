<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Input;

class Contratto extends Model
{

    protected $table = 'contratto';
    public $timestamps = true;

    protected $fillable = [
        'societa_id',
        'cliente_id',
        'progetto_id',
        'stato',
        'importo',
        'modalita_fattura',
        'periodicita_pagamenti',
        'note',
        'data_primo_contatto',
        'data_validita_contratto',
        'data_avvio_progetto',
        'data_chiusura_progetto',
        'rimborsi',
        'fatturazione_id',
        'ripianifica',
        'rapportino',
        'fatturazione_default',
        'link_pdf',
        'link_planner',
        'Rimborso_Forfait',
        'Rimborso_KM',
        'CIG',
        'ODA',
        'desc_breve',
        'agente_id',
        'verificato',
    ];

    protected $nullable = [
    ];
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];


    public function setDataPrimoContattoAttribute($date)
    {
        $this->attributes['data_primo_contatto'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function setDataValiditaContrattoAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_validita_contratto'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_validita_contratto'] = null;
        }
    }

    public function setDataAvvioProgettoAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_avvio_progetto'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_avvio_progetto'] = null;
        }
    }

    public function setDataChiusuraProgettoAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_chiusura_progetto'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_chiusura_progetto'] = null;
        }
    }

    public function getDataPrimoContattoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getDataValiditaContrattoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getDataAvvioProgettoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getDataChiusuraProgettoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function societa()
    {
        return $this->belongsTo(Societa::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function fatturazione()
    {
        return $this->belongsTo(Cliente::class,'fatturazione_id');
    }

    public function agente()
    {
        return $this->belongsTo(Cliente::class,'agente_id');
    }

    public function progetto()
    {
        return $this->belongsTo(Progetto::class);
    }

    public function consulenti()
    {
        return $this->belongsToMany(Consulente::class)->withPivot('note', 'ruolo');
    }

    public function listinoProdotti()
    {
        return $this->hasMany(ContrattoProdotto::class);
    }

    public function listinoInterventi()
    {
        return $this->hasMany(ContrattoIntervento::class);
    }

    public function listinoInterventiValidi()
    {
        return $this->hasMany(ContrattoIntervento::class)->where(function($q){
            $q->WhereNull('data_fine')->orwhereDate('data_inizio', '<=', Carbon::today())->whereDate('data_fine', '>=', Carbon::today());
        });
        
        
        //->WhereNull('data_fine')->whereDate('data_inizio', '<=', Carbon::today())->whereDate('data_fine', '>=', Carbon::today());
    }

    public function prossimiInterventi()
    {
        return $this->hasMany(Intervento::class)->whereDate('data_start', '>', date('Y-m-d'));
    }

    public function interventi()
    {
        return $this->hasMany(Intervento::class);
    }

    public function interventiDaApprovare()
    {
        return $this->hasMany(Intervento::class)->where('approvato', '0')->where('inviato', '1');
        //return $this->hasMany(Intervento::class)->where('approvato', '0')->where('fatturabile', '1');
    }
}
