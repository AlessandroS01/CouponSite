<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {

    protected $table = 'faq';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'domanda',
        'risposta',
    ];

    // id non modificabile da un HTTP Request
    protected $guarded = ['id'];

    public $timestamps = false;


}
