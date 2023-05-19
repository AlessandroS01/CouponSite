    <div class="logo-section">
            <a href="{{ route('home') }}"> <img src="img/logo.png" alt="site logo"> </a>
    </div>

    <ul id="center-links">
        <li><a href="{{ route('home') }}" title="Home">Home</a></li>
        <li><a href="{{ route('catalogo offerte') }}" title="Il nostro catalogo">Catalogo</a></li>
        <li><a href="{{ route('catalogo aziende') }}" title="Le nostre aziende">Aziende</a></li>
        <li><a href="{{ route('contatti') }}" title="Contattaci">Contatti</a></li>
        <li><a href="{{ route('faqs') }}" title="Domande frequenti">FAQs</a></li>


    @can('isAdmin')
        <li><a href="{{ route('admin') }}" class="highlight" title="Home Admin">Home Admin</a></li>
    @endcan
    @can('isStaff')
        <li><a href="{{ route('user') }}" class="highlight" title="Home User">Home User</a></li>
    @endcan
    @can('isUser')
        <li><a href="{{ route('user') }}" class="highlight" title="Home User">Home User</a></li>
    @endcan

    @auth
    <li><a href="" title="Esci dal sito" class="highlight" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
       {{ csrf_field() }}
    </form>
    @endauth
    @guest
       <li><a href="{{ route('login') }}" class="highlight" title="Accedi all'area riservata del sito">Accedi</a></li>
    @endguest
    </ul>
    <!-- TODO AGGIUNGERE I RIFERIMENTI NEL CASO IN CUI UN UTENTE SIA REGISTRATO. GUADARE LARAPROJ 5 PER NAVPUBLIC -->
    <!-- per il logout per questioni di sicurezza si crea un'ancora che al click stoppa la richiesta standard e
        richiama il submit della form che ha come action la rotta logout in metodo post con un display a NONE.
        In questo modo si può aggiugnere il crsf token per la sicurezza -->

    <!--
    {{-- nel caso non ci sia un utente registrato o loggato si usa la condizione @guest
    che fa apparire le 2 ancore per l'utente che è entrato nel sito come un semplice "ospite". --}}
    -->
    <ul id="right-links">
        <li><a href="{{ route('login') }}" title="Accedi">Login</a></li>
        <li><a href="{{ route('register') }}" title="Registrati">SignUp</a></li>
    </ul>

    <!-- title permette di visualizzare il titolo della scheda una volta che il cursore rimane nel contenuto -->
