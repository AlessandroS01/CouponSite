<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Riscatto extends Model {

    protected $table = 'acquisizione';
    protected $primaryKey = ['codicePacchetto', 'usernameCliente'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['codicePacchetto', 'usernameCliente'];

    public $timestamps = false;


}
