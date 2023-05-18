<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model {

    protected $table = 'utente';
    protected $primaryKey = 'username';

    // username non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['username'];

    public $timestamps = false;


}
