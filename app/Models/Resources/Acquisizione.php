<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Acquisizione extends Model {

    protected $table = 'acquisizione';
    protected $primaryKey = ['codiceOfferta', 'usernameCliente'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['codiceOfferta', 'usernameCliente'];

    public $timestamps = false;


}
