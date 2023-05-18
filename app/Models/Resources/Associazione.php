<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Associazione extends Model {

    protected $table = 'associazione';
    protected $primaryKey = ['codicePacchetto', 'codiceOfferta'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['codicePacchetto', 'codiceOfferta'];

    public $timestamps = false;


}
