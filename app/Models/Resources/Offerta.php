<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Offerta extends Model {

    protected $table = 'offerta';
    protected $primaryKey = 'codice';

    // codice non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['codice'];

    public $timestamps = false;


}
