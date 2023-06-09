<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        DB::table('faq')->insert([
            ["domanda" => "Posso avere accesso ai coupon senza registrarmi?", "risposta" => "- No. Per accedere ai vari coupon bisogna essere registrati al nostro sito."],
            ["domanda" => "I coupon hanno una scadenza?", "risposta" => "- Sì, i coupon hanno una data di scadenza"],
            ["domanda" => "Ci sono limiti di utilizzo per i coupon?", "risposta" => "- Sì. Per ogni cliente registrato al sito si può erogare al massimo un coupon per ogni promozione."],
            ["domanda" => "Posso avere accesso ai coupon senza registrarmi?", "risposta" => "- No. Per accedere ai vari coupon bisogna essere registrati al nostro sito."],
            ["domanda" => "I coupon hanno una scadenza?", "risposta" => "- Sì, i coupon hanno una data di scadenza."]
            ]);

        /*
         *
         */
        DB::table('users')->insert([
            [ 'username' => 'useruser', 'password' => Hash::make('nYvpLFCp') ,
                'nome' => 'Utente', 'cognome' => 'Registrato', 'genere' => 'M', 'eta' => 25, 'email' => 'user@example.com',
                'telefono' => 1234567890, 'via' => 'Via Utente Registrato', 'numero_civico' => 1,
                'citta' => 'Città Utente Registrato', 'livello' => 1, 'flagPacchetti' => false,
                'remember_token' => Str::random(10), 'created_at' => now(), 'updated_at' => now()],
            [ 'username' => 'staffstaff',
                'password' => Hash::make('nYvpLFCp') ,
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
                'flagPacchetti' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 'username' => 'adminadmin',
                'password' => Hash::make('nYvpLFCp') ,
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
                'flagPacchetti' => false,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);

        DB::table('azienda')->insert([
            ["partita_iva"=>"00011122233", "nome" => "Mediaworld", "localita" => "Ancona", "tipologia" =>"elettronica", "email"=>"mediaworld@example.com", "telefono" => "0712345560", "descrizione" => "negozio di elettronica e tecnologia", "logo"=>"img/Media_World_Logo.jpg", "ragione_sociale" => "S.p.a"],
            ["partita_iva"=>"00011122234", "nome" => "Euronics", "localita" => "Pescara", "tipologia" =>"elettronica", "email"=>"euronics@example.com", "telefono" => "0712345570", "descrizione" => "negozio di elettronica e tecnologia", "logo"=>"img/euronics.jpg", "ragione_sociale" => "S.p.a"],
            ["partita_iva"=>"00011122235", "nome" => "H&M", "localita" => "Ancona", "tipologia" =>"abbigliamento", "email"=>"h&m@example.com", "telefono" => "0712345580", "descrizione" => "negozio di abbigliamento", "logo"=>"img/HM-Share-Image.jpg", "ragione_sociale" => "S.p.a"],
            ["partita_iva"=>"00011122236", "nome" => "Zara", "localita" => "Ancona", "tipologia" =>"abbigliamento", "email"=>"zara@example.com", "telefono" => "0712345590", "descrizione" => "negozio di abbigliamento", "logo"=>"img/zara.png", "ragione_sociale" => "S.p.a"],
            ["partita_iva"=>"00011122237", "nome" => "Nike", "localita" => "Firenze", "tipologia" =>"abbigliamento", "email"=>"nike@example.com", "telefono" => "0712345600", "descrizione" => "negozio di abbigliamento", "logo"=>"img/nike.png", "ragione_sociale" => "S.p.a"]

        ]);

        DB::table('offerta')->insert([

        ["data_scadenza"=> "2023/06/20", "luogo_fruizione"=> "mediaworld", "modalita_fruizione"=>"online", "percentuale_sconto"=> 20, "prezzo_pieno" => 300, "oggetto_offerta"=>"AirPods 2 Pro", "azienda"=>"00011122233", "staff"=>2, "categoria" => "elettronica", "flagAttivo" => "1", "descrizione" => "Cuffie bluetooth"],
        ["data_scadenza"=> "2023/07/23", "luogo_fruizione"=> "euronics", "modalita_fruizione"=>"negozio fisico", "percentuale_sconto"=> 10, "prezzo_pieno" => 800, "oggetto_offerta"=>"laptop ASUS", "azienda"=>"00011122234", "staff"=>2, "categoria" => "elettronica", "flagAttivo" => "1", "descrizione" => "Cavo hdmi incluso"],
        ["data_scadenza"=> "2023/08/21", "luogo_fruizione"=> "H&M", "modalita_fruizione"=>"negozio fisico", "percentuale_sconto"=> 15, "prezzo_pieno" => 50, "oggetto_offerta"=>"Maglioncino Cropp", "azienda"=>"00011122235", "staff"=>2, "categoria" => "abbigliamento", "flagAttivo" => "1", "descrizione" => "Colletto alto"],
        ["data_scadenza"=> "2023/09/20", "luogo_fruizione"=> "mediaworld", "modalita_fruizione"=>"online", "percentuale_sconto"=> 10, "prezzo_pieno" => 120, "oggetto_offerta"=>"Apple pen", "azienda"=>"00011122233", "staff"=>2, "categoria" => "elettronica", "flagAttivo" => "1", "descrizione" => "Prima generazione"],
        ["data_scadenza"=> "2023/08/12", "luogo_fruizione"=> "euronics", "modalita_fruizione"=>"negozio fisico", "percentuale_sconto"=> 30, "prezzo_pieno" => 900, "oggetto_offerta"=>"laptop MSI", "azienda"=>"00011122234", "staff"=>2, "categoria" => "elettronica", "flagAttivo" => "1", "descrizione" => "Processore Intel i7"],
        ["data_scadenza"=> "2023/11/10", "luogo_fruizione"=> "Zara", "modalita_fruizione"=>"negozio fisico", "percentuale_sconto"=> 15, "prezzo_pieno" => 50, "oggetto_offerta"=>"T-Shirt", "azienda"=>"00011122235", "staff"=>2, "categoria" => "abbigliamento", "flagAttivo" => "1", "descrizione" => "Pacco da 3"]

        ]);



        DB::table('gestione')->insert([
            ["staff"=> 2, "azienda" => "00011122233"],
            ["staff"=> 2, "azienda" => "00011122234"],
            ["staff"=> 2, "azienda" => "00011122235"],
            ["staff"=> 2, "azienda" => "00011122236"],
            ["staff"=> 2, "azienda" => "00011122237"]
        ]);
    }

}
