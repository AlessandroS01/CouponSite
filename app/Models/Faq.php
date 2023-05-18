<?php

namespace App\Models;

class Faq {

    protected $_faq;

    public function __construct() {
        $this->_faq = collect(
                array(
                    (object) array(
                        'id' => '1',
                        'domanda' => 'Posso avere accesso ai coupon senza registrarmi?',
                        'risposta' => '- No. Per accedere ai vari coupon bisogna essere registrati al nostro sito.',
                    ),
                    (object) array(
                        'id' => '2',
                        'domanda' => 'I coupon hanno una scadenza?',
                        'risposta' => '- Sì, i coupon hanno una data di scadenza.',
                    ),
                    (object) array(
                        'id' => '3',
                        'domanda' => 'Ci sono limiti di utilizzo per i coupon?',
                        'risposta' => '- Sì. Per ogni cliente registrato al sito si può erogare al massimo un coupon per ogni promozione.',
                    ),
                    (object) array(
                        'id' => '1',
                        'domanda' => 'Posso avere accesso ai coupon senza registrarmi?',
                        'risposta' => '- No. Per accedere ai vari coupon bisogna essere registrati al nostro sito.',
                    ),
                    (object) array(
                        'id' => '2',
                        'domanda' => 'I coupon hanno una scadenza?',
                        'risposta' => '- Sì, i coupon hanno una data di scadenza.',
                    )
                )
        );
    }

    public function getFaqs(){
        return $this->_faq;
    }

}

