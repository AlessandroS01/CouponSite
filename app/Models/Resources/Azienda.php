<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Azienda extends Model {

    protected $table = 'azienda';
    protected $primaryKey = 'partitaIva';

    // partitaIva non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['partitaIva'];

    public $timestamps = false;


}
