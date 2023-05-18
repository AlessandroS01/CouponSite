@extends('layouts.public')

@section('title', 'Home')


@section('content')
<section id="aziende" class="slide-aziende">

    <div class="title-section-aziende">
        <h1 class="titolo-sezione-aziende">Aziende in evidenza</h1>
    </div>


    <div class="container">



        <div class="slideshow-container">

            <div class="slide fade">
            <div class="numbertext">1 / 3</div>
            <img src="img/amazon.png" style="width:100%">
            </div>

            <div class="slide fade">
            <div class="numbertext">2 / 3</div>
            <img src="img/office.jpg" style="width:100%">
            </div>

            <div class="slide fade">
            <div class="numbertext">3 / 3</div>
            <img src="img/amazon.png" style="width:100%">
            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <div id="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
            </div>


        </div>

        <div id="row-aziende">
            
            <div id="aziende-container">

                <div class="card-azienda">
                <img src="img/amazon.png" >
                <a href="{{ route('azienda') }}">Nome Azienda</a>
                </div>
                
                <div class="card-azienda">
                <img src="img/office.jpg" >
                <a href="{{ route('azienda') }}"">Nome Azienda</a>
                </div>
                
                <div class="card-azienda">
                <img src="img/amazon.png" >
                <a href="{{ route('azienda') }}"">Nome Azienda</a>
                </div>

                <div class="card-azienda">
                <img src="img/office.jpg" >
                <a href="{{ route('azienda') }}"">Nome Azienda</a>
                </div>
                
                <div class="card-azienda">
                <img src="img/amazon.png" >
                <a href="{{ route('azienda') }}"">Nome Azienda</a>
                </div>    

            </div>    
                

        </div>




    </div>

</section>


<section id="offerte-home">

    <!-- Per ogni prodotto ottenuto dal controller gestire il dato-->
    <div class="title-offerte-home">

    <h1>Offerte in evidenza</h1>
    </div>
    
    
    <div class="container-offerte">
        
        <div class="card">
            
            <div class="img-container">
                <img src="img/amazon.png" alt="logo offerta" >
            </div>

            <div class="info">
                <h1>Offerta</h1>
                <p>Descrizione offerta</p>
            </div>

            <div class="button">
                <a href="{{ route('offerta') }}">ottieni</a>
            </div>

            <div class="badge">
                <p>50%</p>
            </div>

            
        </div>

        <div class="card">
            
            <div class="img-container">
                <img src="img/amazon.png" alt="logo offerta" >
            </div>

            <div class="info">
                <h1>Offerta</h1>
                <p>Descrizione offerta</p>
            </div>

            <div class="button">
                <a href="{{ route('offerta') }}">ottieni</a>
            </div>

            <div class="badge">
                <p>50%</p>
            </div>

            
        </div>

        <div class="card">
            
            <div class="img-container">
                <img src="img/amazon.png" alt="logo offerta" >
            </div>

            <div class="info">
                <h1>Offerta</h1>
                <p>Descrizione offerta</p>
            </div>

            <div class="button">
                <a href="{{ route('offerta') }}">ottieni</a>
            </div>

            <div class="badge">
                <p>50%</p>
            </div>

            
        </div>

    </div>  
    
    <div class="title-offerte-home">
        <h1>Scadono a breve</h1>
    </div>

    <div class="container-offerte">

        <div class="card">
            
            <div class="img-container">
                <img src="img/amazon.png" alt="logo offerta" >
            </div>

            <div class="info">
                <h1>Offerta</h1>
                <p>Descrizione offerta</p>
            </div>

            <div class="button">
                <a href="{{ route('offerta') }}">ottieni</a>
            </div>

            <div class="badge">
                <p>50%</p>
            </div>

            
        </div>


        <div class="card">
            
            <div class="img-container">
                <img src="img/amazon.png" alt="logo offerta" >
            </div>

            <div class="info">
                <h1>Offerta</h1>
                <p>Descrizione offerta</p>
            </div>

            <div class="button">
                <a href="{{ route('offerta') }}">ottieni</a>
            </div>

            <div class="badge">
                <p>50%</p>
            </div>

            
        </div>

        <div class="card">
            
            <div class="img-container">
                <img src="img/amazon.png" alt="logo offerta" >
            </div>

            <div class="info">
                <h1>Offerta</h1>
                <p>Descrizione offerta</p>
            </div>

            <div class="button">
                <a href="{{ route('offerta') }}">ottieni</a>
            </div>

            <div class="badge">
                <p>50%</p>
            </div>

            
        </div>




    </div>




</section>
@endsection