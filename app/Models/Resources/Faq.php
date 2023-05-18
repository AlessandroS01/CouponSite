<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {

    protected $table = 'faq';
    protected $primaryKey = 'id';

    // id non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['id'];

    public $timestamps = false;


}
