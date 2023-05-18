<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Riscatto extends Model {

    protected $table = 'acquisizione';
    protected $primaryKey = ['cliente', 'pacchetto'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['cliente', 'pacchetto'];

    public $timestamps = false;


}
