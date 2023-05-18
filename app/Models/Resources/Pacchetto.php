<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Pacchetto extends Model {

    protected $table = 'pacchetto';
    protected $primaryKey = 'pacchettoId';

    // pacchettoId non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['pacchettoId'];

    public $timestamps = false;


}
