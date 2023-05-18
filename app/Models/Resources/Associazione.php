<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Associazione extends Model {

    protected $table = 'associazione';
    protected $primaryKey = ['offerta', 'pacchetto'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['offerta', 'pacchetto'];

    public $timestamps = false;


}
