<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Azienda extends Model {

    protected $table = 'azienda';
    protected $primaryKey = 'partita_iva';

    // partita_iva non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['partita_iva'];

    /*laravel con $keytype interpreta la chiave primaria come stringa e $incrementing= false dice di non autoincrementare la chiave primaria in automatico*/
    protected $keyType = 'string';

    public $timestamps = false;

}
