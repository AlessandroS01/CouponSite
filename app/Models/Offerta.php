<?php

namespace App\Models;

class Offerta {

    protected $_offerte;

    public function __construct() {
        $this->_offerte = collect(
                array(
                    (object) array(
                        'codice' => '1',
                        'luogo_fruizione' => 'Sito',
                        'modalita_fruizione' => '1',
                        'percentuale_sconto' => '1',
                        'prezzo_pieno' => '1',
                        'oggetto_offerta' => '1',
                        'azienda' => '1',
                        'staff' => '1',
                    ),
                )
        );
    }

    public function getOfferta(){
        return $this->_offerte;
    }

}