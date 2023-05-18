<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Acquisizione extends Model {

    protected $table = 'acquisizione';
    protected $primaryKey = ['offerta', 'cliente'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['offerta', 'cliente'];

    public $timestamps = false;


}
