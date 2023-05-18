@extends('layouts.public')

@section('title', 'Catalogo aziende')

@section('content')

<section class="catalogo">
        <div class="catalogo-offerte">

            <div class="filters">
                <h2>Filtri</h2>
                
                <button class="accordion" id="first-filter" >Settore</button> 
                <div class="accordion-panel"> 
                             
                    <div id="settore" class="filter-items">    
                            
                        <label>
                            <input type="radio" name="settore" />
                            <span class="label-text">Informatica</span>
                        </label>
                        
                        

                        <label>
                            <input type="radio" name="settore" />
                            <span class="label-text">Abbigliamento</span>
                        </label>

                        

                        <label>
                            <input type="radio" name="settore" />
                            <span class="label-text">Alimentari</span>
                        </label>
                    
                    </div>

                </div>

                
            </div>

            <div class="container-offerte">
                <div class="offerte">
                
                    <div class="card">
                        
                        <div class="img-container">
                            <img src="img/amazon.png" alt="logo offerta" >
                        </div>

                        <div class="info">
                            <h1>Azienda</h1>
                            <p>Descrizione azienda</p>
                        </div>

                        <div class="button">
                            <a href="{{ route('azienda') }}">Visualizza</a>
                        </div>
                        
                    </div>


                </div>


            </div>
            
        </div>
    </section>
@endsection