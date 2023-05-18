<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Gestione extends Model {

    protected $table = 'gestione';
    protected $primaryKey = ['partitaIvaAzienda', 'unsernameStaff'];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['partitaIvaAzienda', 'unsernameStaff'];

    public $timestamps = false;


}
