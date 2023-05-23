<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Acquisizione extends Model {

    protected $table = 'acquisizione';
    protected $primaryKey = 'id';


    protected $fillable = [
        'codice_coupon',
        'offerta',
        'cliente',
    ];


    // primary key non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['offerta', 'cliente'];

    public $timestamps = true;


}
