<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {

    protected $table = 'faq';
    protected $primaryKey = 'faqId';

    // faqId non modificabile da un HTTP Request (Mass Assignment)
    protected $guarded = ['faqId'];

    public $timestamps = false;


}
