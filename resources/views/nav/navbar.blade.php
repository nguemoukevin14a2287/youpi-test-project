<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span><img src="{{asset('assets/n.png')}}" alt="" width="80px" class="img-fluid logo"></span></a>
        <button class="navbar-toggler bg-white " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon bg-white"></span>
        </button>
            <div class="collapse navbar-collapse men" id="navbarNav">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_home') active @endif" href="{{ route('app_home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_reglement') active @endif"  href="{{ route('app_reglement') }}">Règlement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_inscription') active @endif"  href="{{ route('app_inscription') }}">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_about') active @endif" href="{{ route('app_about') }}">COMMILEAD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_patner') active @endif" href="{{ route('app_patner') }}">Partenariat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_candidat') active @endif" href="{{ route('app_candidat') }}">Candidats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if(Request::route()->getName() =='app_contact') active @endif" href="{{ route('app_contact') }}">Nous contacter</a>
                    </li>
                </ul>
            </div>
    </div>
</nav>
