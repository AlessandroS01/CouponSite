<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Gestione extends Model {

    protected $table = 'gestione';
    protected $primaryKey = 'id';

    protected $fillable = [
        'staff',
        'azienda',
    ];

    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['staff', 'azienda'];

    public $timestamps = false;


}
