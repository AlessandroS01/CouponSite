<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;


class Azienda extends Model
{
    protected $table = 'azienda';
    protected $primaryKey = 'partita_iva';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = ['partita_iva'];

    protected $fillable = [
        'partita_iva',
        'nome',
        'email',
        'localita',
        'tipologia',
        'telefono',
        'descrizione',
        'ragione_sociale',
        'logo',
    ];
}
