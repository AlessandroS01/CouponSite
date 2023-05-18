<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Offerta extends Model {

    protected $table = 'offerta';
    protected $primaryKey = 'offertaId';

    // offertaId non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['offertaId'];

    public $timestamps = false;


}
