<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Consulente extends Model
{

    protected $table = 'consulente';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'codice_fiscale', 'cognome', 'nome', 'indirizzo', 'citta', 'provincia', 'cap', 'telefono', 'mobile', 'telefono2', 'mobile2', 'partita_iva', 'tipo','rapportino','ripianifica','sesso','data_nascita','CDC','area','CV', 'data_assunzione', 'data_cessazione', 'rapporto', 'sito'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function interventi()
    {
        return $this->user->interventi();
    }

    public function setDataNascitaAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_nascita'] = Carbon::createFromFormat('d/m/Y', $date)->startOfDay();
        } else {
            $this->attributes['data_nascita'] = null;
        }
    }
    public function getDataNascitaAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function setDataAssunzioneAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_assunzione'] = Carbon::createFromFormat('d/m/Y', $date)->startOfDay();
        } else {
            $this->attributes['data_assunzione'] = null;
        }
    }
    public function getDataAssunzioneAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function setDataCessazioneAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_cessazione'] = Carbon::createFromFormat('d/m/Y', $date)->startOfDay();
        } else {
            $this->attributes['data_cessazione'] = null;
        }
    }
    public function getDataCessazioneAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getNominativoAttribute()
    {
        return $this->nome . ' ' . $this->cognome;
    }

    public function contratti()
    {
        return $this->belongsToMany(Contratto::class)->with('progetto')->withPivot('note', 'ruolo')->where('contratto.stato', '<>', 'CLOSED');
    }

    public function capoProgetto()
    {
        return $this->belongsToMany(Contratto::class)->withPivot('note', 'ruolo')->where('ruolo', 'Capo Progetto')->where('contratto.stato', '<>', 'CLOSED');
    }

    public function contrattiDaFatturare()
    {
        //return $this->belongsToMany(Contratto::class)->withPivot('note', 'ruolo')->where('ruolo', 'Capo Progetto');
        return $this->belongsToMany(Contratto::class)->withPivot('note', 'ruolo')->where('ruolo', 'Capo Progetto')->where('contratto.fatturazione_default','1');
    }

    public function canPianificare($contratto_id)
    {
        if ($this->contratti->where('id', $contratto_id)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
