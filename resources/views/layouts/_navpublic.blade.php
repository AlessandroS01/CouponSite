    <div class="logo-section">
            <a href="{{ route('home') }}"> <img src="{{ asset('img/logo.png') }}" alt="site logo"> </a>
    </div>

    <ul id="center-links">

        <li><a href="{{ route('home') }}" title="Home">Home</a></li>
        <li><a href="{{ route('catalogo offerte') }}" title="Il nostro catalogo">Catalogo</a></li>
        <li><a href="{{ route('catalogo aziende') }}" title="Le nostre aziende">Aziende</a></li>
        <li><a href="{{ route('contatti') }}" title="Contattaci">Contatti</a></li>
        <li><a href="{{ route('faqs') }}" title="Domande frequenti">FAQs</a></li>

        @can('isStaff')
            <li><a href="{{ route('pannello staff') }}" class="highlight" title="Pannello di gestione">Gestione</a></li>
        @endcan

        @can('isAdmin')
            <li><a href="{{ route('pannello_admin') }}" class="highlight" title="Pannello di gestione">Gestione</a></li>

        @endcan

    </ul>

    @guest

        <ul id="right-links">
            <li><a href="{{ route('login') }}" title="Accedi">Login</a></li>
            <li><a href="{{ route('register') }}" title="Registrati">SignUp</a></li>
        </ul>

    @endguest

    @auth

        <ul id="right-links">
            @canany(['isStaff', 'isUser'])
                <li><a href="{{ route('profilo') }}" class="highlight" title="Home Admin">Profilo</a></li>
            @endcanany
                <li><a href="#" title="Esci dal sito" class="highlight" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </ul>

    @endauth
