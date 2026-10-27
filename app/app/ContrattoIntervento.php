<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class ContrattoIntervento extends Model {

    protected $table = 'contratto_intervento';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'contratto_id',
        'descrizione',
        'tariffa_ora',
        'iva',
        'tipo_iva',
        'ore_previste',
        'tariffa_giornata',
        'ODA',
        'CIG',
        'data_inizio',
        'data_fine',
        'doc'
    ];

    public function contratto()
    {
        return $this->belongsTo(Contratto::class);
    }

    public function interventi()
    {
        return $this->hasMany(Intervento::class, 'listino_id', 'id');
    }

    public function interventi_wt()
    {
        return $this->hasMany('App\Intervento', 'listino_id', 'id')->withTrashed();
    }

    public function setDataInizioAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_inizio'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_inizio'] = null;
        }
    }
    public function getDataInizioAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function setDataFineAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_fine'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_fine'] = null;
        }
    }
    public function getDataFineAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }
}
