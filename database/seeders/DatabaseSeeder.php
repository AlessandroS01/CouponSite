<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    const DESCPROD = '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>';

    public function run() {

        DB::table('faq')->insert([
            ["domanda" => "Posso avere accesso ai coupon senza registrarmi?", "risposta" => "- No. Per accedere ai vari coupon bisogna essere registrati al nostro sito."],
            ["domanda" => "I coupon hanno una scadenza?", "risposta" => "- Sì, i coupon hanno una data di scadenza"],
            ["domanda" => "Ci sono limiti di utilizzo per i coupon?", "risposta" => "- Sì. Per ogni cliente registrato al sito si può erogare al massimo un coupon per ogni promozione."],
            ["domanda" => "Posso avere accesso ai coupon senza registrarmi?", "risposta" => "- No. Per accedere ai vari coupon bisogna essere registrati al nostro sito."],
            ["domanda" => "I coupon hanno una scadenza?", "risposta" => "- Sì, i coupon hanno una data di scadenza."]
            ]);

        DB::table('utente')->insert([
            [ 'username' => 'useruser', 'password' => 'nYvpLFCp',
                'nome' => 'Utente', 'cognome' => 'Registrato', 'genere' => 'M', 'eta' => 25, 'email' => 'user@example.com', 'telefono' => 1234567890,
                'via' => 'Via Utente Registrato', 'numero_civico' => 1, 'citta' => 'Città Utente Registrato', 'livello' => 1,
                'remember_token' => Str::random(10), 'created_at' => now(), 'updated_at' => now()],
            [ 'username' => 'staffstaff',
                'password' => 'nYvpLFCp',
                'nome' => 'Membro',
                'cognome' => 'Staff',
                'genere' => 'M',
                'eta' => 30,
                'email' => 'staff@example.com',
                'telefono' => 9876543210,
                'via' => 'Via Membro Staff',
                'numero_civico' => 2,
                'citta' => 'Città Membro Staff',
                'livello' => 2,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 'username' => 'adminadmin',
                'password' => 'nYvpLFCp',
                'nome' => 'Amministratore',
                'cognome' => 'Admin',
                'genere' => 'M',
                'eta' => 35,
                'email' => 'admin@example.com',
                'telefono' => 5432167890,
                'via' => 'Via Amministratore',
                'numero_civico' => 3,
                'citta' => 'Città Amministratore',
                'livello' => 3,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);

        DB::table('azienda')->insert([
            ["partita_iva"=>"00011122233", "nome" => "mediaworld", "localita" => "Ancona", "tipologia" =>"elettronica", "descrizione" => "negozio di elettronica e tecnologia", "logo"=>"prova.jpg", "ragione_sociale" => "S.p.a"],
            ["partita_iva"=>"00011122234", "nome" => "euronics", "localita" => "Pescara", "tipologia" =>"elettronica", "descrizione" => "negozio di elettronica e tecnologia", "logo"=>"prova.jpg", "ragione_sociale" => "S.p.a"],
            ["partita_iva"=>"00011122235", "nome" => "H&M", "localita" => "Ancona", "tipologia" =>"abbigliamento", "descrizione" => "negozio di abbigliamento", "logo"=>"prova.jpg", "ragione_sociale" => "S.p.a"],

        ]);

        DB::table('offerta')->insert([
        ["data_scadenza"=> "2023/06/20", "luogo_fruizione"=> "mediaworld", "modalita_fruizione"=>"online", "percentuale_sconto"=> 20, "prezzo_pieno" => 300, "oggetto_offerta"=>"AirPods 2 Pro", "azienda"=>"00011122233", "staff"=>"staffstaff", "categoria" => "elettronica"],
        ["data_scadenza"=> "2023/07/23", "luogo_fruizione"=> "euronics", "modalita_fruizione"=>"negozio fisico", "percentuale_sconto"=> 10, "prezzo_pieno" => 800, "oggetto_offerta"=>"laptop ASUS", "azienda"=>"00011122234", "staff"=>"staffstaff", "categoria" => "elettronica"],
        ["data_scadenza"=> "2023/08/21", "luogo_fruizione"=> "H&M", "modalita_fruizione"=>"negozio fisico", "percentuale_sconto"=> 15, "prezzo_pieno" => 50, "oggetto_offerta"=>"Maglioncino Cropp", "azienda"=>"00011122235", "staff"=>"staffstaff", "categoria" => "abbigliamento"]

        ]);



        DB::table('gestione')->insert([
            ["staff"=> "staffstaff", "azienda" => "00011122233"],
            ["staff"=> "staffstaff", "azienda" => "00011122234"],
            ["staff"=> "staffstaff", "azienda" => "00011122235"]
        ]);




    }

}
