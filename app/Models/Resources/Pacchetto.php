<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Pacchetto extends Model {

    protected $table = 'pacchetto';
    protected $primaryKey = 'codice';

    // codice non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['codice'];

    public $timestamps = false;


}
