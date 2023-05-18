<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Azienda extends Model {

    protected $table = 'azienda';
    protected $primaryKey = 'partita_iva';

    // partita_iva non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['partita_iva'];

    public $timestamps = false;


}
